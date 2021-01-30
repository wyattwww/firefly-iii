<?php
/**
 * AccountUpdateService.php
 * Copyright (c) 2019 james@firefly-iii.org
 *
 * This file is part of Firefly III (https://github.com/firefly-iii).
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace FireflyIII\Services\Internal\Update;

use FireflyIII\Models\Account;
use FireflyIII\Models\AccountType;
use FireflyIII\Models\Location;
use FireflyIII\Repositories\Account\AccountRepositoryInterface;
use FireflyIII\Services\Internal\Support\AccountServiceTrait;
use FireflyIII\User;
use Log;

/**
 * Class AccountUpdateService
 */
class AccountUpdateService
{
    use AccountServiceTrait;

    protected AccountRepositoryInterface $accountRepository;
    protected array                      $validAssetFields;
    protected array                      $validCCFields;
    protected array                      $validFields;
    private array                        $canHaveVirtual;
    private User                         $user;

    /**
     * Constructor.
     */
    public function __construct()
    {
        if ('testing' === config('app.env')) {
            Log::warning(sprintf('%s should not be instantiated in the TEST environment!', get_class($this)));
        }
        // TODO move to configuration.
        $this->canHaveVirtual    = [AccountType::ASSET, AccountType::DEBT, AccountType::LOAN, AccountType::MORTGAGE, AccountType::CREDITCARD];
        $this->accountRepository = app(AccountRepositoryInterface::class);
        $this->validAssetFields  = ['account_role', 'account_number', 'currency_id', 'BIC', 'include_net_worth'];
        $this->validCCFields     = ['account_role', 'cc_monthly_payment_date', 'cc_type', 'account_number', 'currency_id', 'BIC', 'include_net_worth'];
        $this->validFields       = ['account_number', 'currency_id', 'BIC', 'interest', 'interest_period', 'include_net_worth'];
    }

    /**
     * Update account data.
     *
     * @param Account $account
     * @param array   $data
     *
     * @return Account
     */
    public function update(Account $account, array $data): Account
    {
        $this->accountRepository->setUser($account->user);
        $this->user = $account->user;
        $account    = $this->updateAccount($account, $data);

        // find currency, or use default currency instead.
        if (isset($data['currency_id']) && (null !== $data['currency_id'] || null !== $data['currency_code'])) {
            $currency = $this->getCurrency((int)($data['currency_id'] ?? null), (string)($data['currency_code'] ?? null));
            unset($data['currency_code']);
            $data['currency_id'] = $currency->id;
        }

        // update all meta data:
        $this->updateMetaData($account, $data);

        // update, delete or create location:
        $this->updateLocation($account, $data);

        // update opening balance.
        $this->updateOpeningBalance($account, $data);

        // update note:
        if (isset($data['notes']) && null !== $data['notes']) {
            $this->updateNote($account, (string)$data['notes']);
        }

        // update preferences if inactive:
        $this->updatePreferences($account, $data);

        return $account;
    }

    /**
     * @param Account $account
     * @param array   $data
     */
    private function updateLocation(Account $account, array $data): void {
        $updateLocation = $data['update_location'] ?? false;



        // location must be updated?
        if (true === $updateLocation) {
            // if all set to NULL, delete
            if (null === $data['latitude'] && null === $data['longitude'] && null === $data['zoom_level']) {
                $account->locations()->delete();
            }

            // otherwise, update or create.
            if (!(null === $data['latitude'] && null === $data['longitude'] && null === $data['zoom_level'])) {
                $location = $this->accountRepository->getLocation($account);
                if (null === $location) {
                    $location = new Location;
                    $location->locatable()->associate($account);
                }

                $location->latitude   = $data['latitude'] ?? config('firefly.default_location.latitude');
                $location->longitude  = $data['longitude'] ?? config('firefly.default_location.longitude');
                $location->zoom_level = $data['zoom_level'] ?? config('firefly.default_location.zoom_level');
                $location->save();
            }
        }
    }

    /**
     * @param Account $account
     *
     * @return bool
     */
    private function isLiability(Account $account): bool
    {
        $type = $account->accountType->type;

        return in_array($type, [AccountType::DEBT, AccountType::LOAN, AccountType::MORTGAGE], true);
    }

    /**
     * @param int $accountTypeId
     *
     * @return bool
     */
    private function isLiabilityTypeId(int $accountTypeId): bool
    {
        if (0 === $accountTypeId) {
            return false;
        }

        return 1 === AccountType::whereIn('type', [AccountType::DEBT, AccountType::LOAN, AccountType::MORTGAGE])->where('id', $accountTypeId)->count();
    }

    /**
     * @param Account $account
     * @param array   $data
     *
     * @return Account
     */
    private function updateAccount(Account $account, array $data): Account
    {
        // update the account itself:
        $account->name   = $data['name'] ?? $account->name;
        $account->active = $data['active'] ?? $account->active;
        $account->iban   = $data['iban'] ?? $account->iban;
        $account->order  = $data['order'] ?? $account->order;

        // if account type is a liability, the liability type (account type)
        // can be updated to another one.
        if ($this->isLiability($account) && $this->isLiabilityTypeId((int)($data['account_type_id'] ?? 0))) {
            $account->account_type_id = (int)$data['account_type_id'];
        }

        // update virtual balance (could be set to zero if empty string).
        if (null !== $data['virtual_balance']) {
            $account->virtual_balance = '' === trim($data['virtual_balance']) ? '0' : $data['virtual_balance'];
        }

        $account->save();

        return $account;
    }

    /**
     * @param Account $account
     * @param array   $data
     */
    private function updatePreferences(Account $account, array $data): void
    {
        Log::debug(sprintf('Now in updatePreferences(#%d)', $account->id));
        if (array_key_exists('active', $data) && (false === $data['active'] || 0 === $data['active'])) {
            Log::debug('Account was marked as inactive.');
            $preference = app('preferences')->getForUser($account->user, 'frontpageAccounts');
            if (null !== $preference) {
                $removeAccountId = (int)$account->id;
                $array           = $preference->data;
                Log::debug('Current list of accounts: ', $array);
                Log::debug(sprintf('Going to remove account #%d', $removeAccountId));
                $filtered        = array_filter(
                    $array, function ($accountId) use ($removeAccountId) {
                    return (int)$accountId !== $removeAccountId;
                }
                );
                Log::debug('Left with accounts', array_values($filtered));
                app('preferences')->setForUser($account->user, 'frontpageAccounts', array_values($filtered));
                app('preferences')->forget($account->user, 'frontpageAccounts');
                return;
            }
            Log::debug("Found no frontpageAccounts preference, do nothing.");
            return;
        }
        Log::debug('Account was not marked as inactive, do nothing.');
    }

    /**
     * @param Account $account
     * @param array   $data
     */
    private function updateOpeningBalance(Account $account, array $data): void
    {

        // has valid initial balance (IB) data?
        $type = $account->accountType;
        // if it can have a virtual balance, it can also have an opening balance.

        if (in_array($type->type, $this->canHaveVirtual, true)) {

            // check if is submitted as empty, that makes it valid:
            if ($this->validOBData($data) && !$this->isEmptyOBData($data)) {
                $this->updateOBGroup($account, $data);
            }

            if (!$this->validOBData($data) && $this->isEmptyOBData($data)) {
                $this->deleteOBGroup($account);
            }
        }
    }
}

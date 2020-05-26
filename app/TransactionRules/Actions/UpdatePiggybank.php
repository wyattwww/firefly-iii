<?php
declare(strict_types=1);


namespace FireflyIII\TransactionRules\Actions;


use FireflyIII\Models\PiggyBank;
use FireflyIII\Models\RuleAction;
use FireflyIII\Models\Transaction;
use FireflyIII\Models\TransactionJournal;
use FireflyIII\Models\TransactionType;
use FireflyIII\Repositories\PiggyBank\PiggyBankRepositoryInterface;
use FireflyIII\User;
use Log;

/**
 * Class UpdatePiggybank
 */
class UpdatePiggybank implements ActionInterface
{

    /** @var RuleAction The rule action */
    private $action;

    /**
     * TriggerInterface constructor.
     *
     * @param RuleAction $action
     */
    public function __construct(RuleAction $action)
    {
        $this->action = $action;
    }

    /**
     * @inheritDoc
     */
    public function act(TransactionJournal $journal): bool
    {
        Log::debug(sprintf('Triggered rule action UpdatePiggybank on journal #%d', $journal->id));
        if (TransactionType::TRANSFER !== $journal->transactionType->type) {
            Log::info(sprintf('Journal #%d is a "%s" so skip this action.', $journal->id, $journal->transactionType->type));

            return false;
        }
        $piggyBank = $this->findPiggybank($journal->user);
        if (null === $piggyBank) {
            Log::info(
                sprintf(
                    'No piggy bank names "%s", cant execute action #%d of rule #%d ("%s")',
                    $this->action->value, $this->action->id, $this->action->rule_id, $this->action->rule->title,
                )
            );

            return false;
        }

        Log::debug(sprintf('Found piggy bank #%d ("%s")', $piggyBank->id, $piggyBank->name));

        /** @var Transaction $source */
        $source = $journal->transactions()->where('amount', '<', 0)->first();
        /** @var Transaction $destination */
        $destination = $journal->transactions()->where('amount', '>', 0)->first();

        if ((int) $source->account_id === (int) $piggyBank->account_id) {
            Log::debug('Piggy bank account is linked to source, so remove amount.');
            $this->removeAmount($journal, $piggyBank, $destination->amount);


            return true;
        }
        if ((int) $destination->account_id === (int) $piggyBank->account_id) {
            Log::debug('Piggy bank account is linked to source, so add amount.');
            $this->addAmount($journal, $piggyBank, $destination->amount);

            return true;
        }
        Log::info('Piggy bank is not linked to source or destination, so no action will be taken.');

        return true;
    }

    /**
     * @param TransactionJournal $journal
     * @param PiggyBank          $piggyBank
     * @param string             $amount
     */
    private function addAmount(TransactionJournal $journal, PiggyBank $piggyBank, string $amount): void
    {
        $repository = app(PiggyBankRepositoryInterface::class);
        $repository->setUser($journal->user);

        // how much can we add to the piggy bank?
        $toAdd = bcsub($piggyBank->targetamount, $repository->getCurrentAmount($piggyBank));
        Log::debug(sprintf('Max amount to add to piggy bank is %s, amount is %s', $toAdd, $amount));

        // update amount to fit:
        $amount = -1 === bccomp($amount, $toAdd) ? $amount : $toAdd;
        Log::debug(sprintf('Amount is now %s', $amount));

        // if amount is zero, stop.
        if (0 === bccomp('0', $amount)) {
            Log::warning('Amount left is zero, stop.');

            return;
        }

        // make sure we can add amount:
        if (false === $repository->canAddAmount($piggyBank, $amount)) {
            Log::warning(sprintf('Cannot add %s to piggy bank.', $amount));

            return;
        }
        Log::debug(sprintf('Will now add %s to piggy bank.', $amount));

        $repository->addAmount($piggyBank, $amount);
        $repository->createEventWithJournal($piggyBank, app('steam')->positive($amount), $journal);
    }

    /**
     * @param User $user
     *
     * @return PiggyBank|null
     */
    private function findPiggybank(User $user): ?PiggyBank
    {
        return $user->piggyBanks()->where('piggy_banks.name', $this->action->action_value)->first();
    }

    /**
     * @param TransactionJournal $journal
     * @param PiggyBank          $piggyBank
     * @param string             $amount
     */
    private function removeAmount(TransactionJournal $journal, PiggyBank $piggyBank, string $amount): void
    {
        $repository = app(PiggyBankRepositoryInterface::class);
        $repository->setUser($journal->user);

        // how much can we remove from piggy bank?
        $toRemove = $repository->getCurrentAmount($piggyBank);
        Log::debug(sprintf('Amount is %s, max to remove is %s', $amount, $toRemove));
        // if $amount is bigger than $toRemove, shrink it.
        $amount = -1 === bccomp($amount, $toRemove) ? $amount : $toRemove;
        Log::debug(sprintf('Amount is now %s', $amount));

        // if amount is zero, stop.
        if (0 === bccomp('0', $amount)) {
            Log::warning('Amount left is zero, stop.');

            return;
        }

        // make sure we can remove amount:
        if (false === $repository->canRemoveAmount($piggyBank, $amount)) {
            Log::warning(sprintf('Cannot remove %s from piggy bank.', $amount));

            return;
        }
        Log::debug(sprintf('Will now remove %s from piggy bank.', $amount));

        $repository->removeAmount($piggyBank, $amount);
        $repository->createEventWithJournal($piggyBank, app('steam')->negative($amount), $journal);
    }
}

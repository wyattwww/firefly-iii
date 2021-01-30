<?php

/**
 * AvailableBudgetController.php
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

namespace FireflyIII\Api\V1\Controllers\Chart;


use FireflyIII\Api\V1\Controllers\Controller;
use FireflyIII\Models\AvailableBudget;
use FireflyIII\Repositories\Budget\BudgetRepositoryInterface;
use FireflyIII\Repositories\Budget\OperationsRepositoryInterface;
use FireflyIII\User;
use Illuminate\Http\JsonResponse;

/**
 * Class AvailableBudgetController
 */
class AvailableBudgetController extends Controller
{
    private OperationsRepositoryInterface $opsRepository;
    private BudgetRepositoryInterface     $repository;

    /**
     * AvailableBudgetController constructor.
     *
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(
            function ($request, $next) {
                /** @var User $user */
                $user                = auth()->user();
                $this->repository    = app(BudgetRepositoryInterface::class);
                $this->opsRepository = app(OperationsRepositoryInterface::class);
                $this->repository->setUser($user);
                $this->opsRepository->setUser($user);

                return $next($request);
            }
        );
    }

    /**
     * @param AvailableBudget $availableBudget
     *
     * @return JsonResponse
     */
    public function overview(AvailableBudget $availableBudget): JsonResponse
    {
        $currency             = $availableBudget->transactionCurrency;
        $budgets              = $this->repository->getActiveBudgets();
        $newBudgetInformation = $this->opsRepository->sumExpenses($availableBudget->start_date, $availableBudget->end_date, null, $budgets);
        $spent                = '0';

        foreach ($newBudgetInformation as $currencyId => $info) {
            if ($currencyId === (int) $availableBudget->transaction_currency_id) {
                $spent = $info['sum'];
            }
        }

        $left = bcadd($availableBudget->amount, $spent);
        // left less than zero? Set to zero.
        if (-1 === bccomp($left, '0')) {
            $left = '0';
        }

        $chartData = [
            [
                'label'                   => trans('firefly.spent'),
                'currency_id'             => $currency->id,
                'currency_code'           => $currency->code,
                'currency_symbol'         => $currency->symbol,
                'currency_decimal_places' => $currency->decimal_places,
                'type'                    => 'pie',
                'yAxisID'                 => 0, // 0, 1, 2
                'entries'                 => [$spent * -1],
            ],
            [
                'label'                   => trans('firefly.left'),
                'currency_id'             => $currency->id,
                'currency_code'           => $currency->code,
                'currency_symbol'         => $currency->symbol,
                'currency_decimal_places' => $currency->decimal_places,
                'type'                    => 'line', // line, area or bar
                'yAxisID'                 => 0, // 0, 1, 2
                'entries'                 => [round($left, $currency->decimal_places)],
            ],
        ];

        return response()->json($chartData);
    }

}

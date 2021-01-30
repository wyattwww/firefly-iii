<?php

/**
 * CategoryController.php
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

use Carbon\Carbon;
use FireflyIII\Api\V1\Controllers\Controller;
use FireflyIII\Api\V1\Requests\DateRequest;
use FireflyIII\Repositories\Category\CategoryRepositoryInterface;
use FireflyIII\Repositories\Category\NoCategoryRepositoryInterface;
use FireflyIII\Repositories\Category\OperationsRepositoryInterface;
use FireflyIII\User;
use Illuminate\Http\JsonResponse;

/**
 * Class CategoryController
 */
class CategoryController extends Controller
{
    private CategoryRepositoryInterface   $categoryRepository;
    private NoCategoryRepositoryInterface $noCatRepository;
    private OperationsRepositoryInterface $opsRepository;
    private array                         $categories;

    /**
     * AccountController constructor.
     *
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(
            function ($request, $next) {
                /** @var User $user */
                $user                     = auth()->user();
                $this->categoryRepository = app(CategoryRepositoryInterface::class);
                $this->opsRepository      = app(OperationsRepositoryInterface::class);
                $this->noCatRepository    = app(NoCategoryRepositoryInterface::class);
                $this->categories         = [];
                $this->categoryRepository->setUser($user);
                $this->opsRepository->setUser($user);
                $this->noCatRepository->setUser($user);

                return $next($request);
            }
        );
    }


    /**
     * @param DateRequest $request
     *
     * @return JsonResponse
     */
    public function overview(DateRequest $request): JsonResponse
    {
        // parameters for chart:
        $dates = $request->getAll();
        /** @var Carbon $start */
        $start = $dates['start'];
        /** @var Carbon $end */
        $end = $dates['end'];

        $tempData     = [];
        $spentWith    = $this->opsRepository->listExpenses($start, $end);
        $spentWithout = $this->noCatRepository->listExpenses($start, $end);

        /** @var array $set */
        foreach ([$spentWith, $spentWithout,] as $set) {
            $tempData = $this->processArray($tempData, $set);
        }

        $chartData = $this->sortArray($tempData);

        return response()->json($chartData);
    }

    /**
     * @param array $tempData
     * @param array $set
     *
     * @return array
     */
    private function processArray(array $tempData, array $set): array
    {
        foreach ($set as $currency) {
            foreach ($currency['categories'] as $category) {
                $this->categories[] = $category['name'];
                $outKey             = sprintf('%d-e', $currency['currency_id']);
                $tempData[$outKey]  = $tempData[$outKey] ?? [
                        'currency_id'             => $currency['currency_id'],
                        'label'                   => (string)trans('firefly.box_spent_in_currency', ['currency' => $currency['currency_name']]),
                        'currency_code'           => $currency['currency_code'],
                        'currency_symbol'         => $currency['currency_symbol'],
                        'currency_decimal_places' => $currency['currency_decimal_places'],
                        'type'                    => 'bar', // line, area or bar
                        'yAxisID'                 => 0, // 0, 1, 2
                        'entries'                 => [],
                    ];

                foreach ($category['transaction_journals'] as $journal) {
                    // is it expense or income?
                    $currentKey                              = sprintf('%d-%s', $currency['currency_id'], 'e');
                    $name                                    = $category['name'];
                    $tempData[$currentKey]['entries'][$name] = $tempData[$currentKey]['entries'][$name] ?? '0';
                    $tempData[$currentKey]['entries'][$name] = bcadd($tempData[$currentKey]['entries'][$name], $journal['amount']);
                }
            }
        }

        return $tempData;
    }

    /**
     * @param array $tempData
     *
     * @return array
     */
    private function sortArray(array $tempData): array
    {
        // re-sort every spent array and add 0 for missing entries.
        foreach ($tempData as $index => $set) {
            $oldSet = $set['entries'];
            $newSet = [];
            foreach ($this->categories as $category) {
                $value             = $oldSet[$category] ?? '0';
                $value             = -1 === bccomp($value, '0') ? bcmul($value, '-1') : $value;
                $newSet[$category] = $value;
            }
            $tempData[$index]['entries'] = $newSet;
        }

        return array_values($tempData);
    }
}

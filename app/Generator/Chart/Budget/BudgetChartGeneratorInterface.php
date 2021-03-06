<?php
declare(strict_types = 1);
/**
 * BudgetChartGeneratorInterface.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FireflyIII\Generator\Chart\Budget;

use Illuminate\Support\Collection;

/**
 * Interface BudgetChartGeneratorInterface
 *
 * @package FireflyIII\Generator\Chart\Budget
 */
interface BudgetChartGeneratorInterface
{
    /**
     * @param Collection $entries
     *
     * @return array
     */
    public function budget(Collection $entries): array;

    /**
     * @param Collection $entries
     *
     * @return array
     */
    public function budgetLimit(Collection $entries): array;

    /**
     * @param Collection $entries
     *
     * @return array
     */
    public function frontpage(Collection $entries): array;

    /**
     * @param Collection $entries
     *
     * @return array
     */
    public function multiYear(Collection $entries): array;

    /**
     * @param Collection $budgets
     * @param Collection $entries
     *
     * @return array
     */
    public function year(Collection $budgets, Collection $entries): array;

}

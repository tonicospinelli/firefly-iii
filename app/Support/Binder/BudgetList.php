<?php
declare(strict_types = 1);
/**
 * BudgetList.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace FireflyIII\Support\Binder;

use Auth;
use FireflyIII\Models\Budget;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class BudgetList
 *
 * @package FireflyIII\Support\Binder
 */
class BudgetList implements BinderInterface
{

    /**
     * @param $value
     * @param $route
     *
     * @return mixed
     */
    public static function routeBinder($value, $route): Collection
    {
        if (Auth::check()) {
            $ids = explode(',', $value);
            /** @var \Illuminate\Support\Collection $object */
            $object = Budget::where('active', 1)
                            ->whereIn('id', $ids)
                            ->where('user_id', Auth::user()->id)
                            ->get();

            // add empty budget if applicable.
            if (in_array('0', $ids)) {
                $object->push(new Budget);
            }

            if ($object->count() > 0) {
                return $object;
            }
        }
        throw new NotFoundHttpException;
    }
}

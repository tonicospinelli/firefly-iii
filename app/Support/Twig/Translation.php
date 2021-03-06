<?php
declare(strict_types = 1);

namespace FireflyIII\Support\Twig;

use Twig_Extension;
use Twig_SimpleFilter;

/**
 *
 * Class Budget
 *
 * @package FireflyIII\Support\Twig
 */
class Translation extends Twig_Extension
{

    /**
     * @return array
     */
    public function getFilters(): array
    {
        $filters = [];

        $filters[] = new Twig_SimpleFilter(
            '_', function ($name) {

            return trans('firefly.' . $name);

        }, ['is_safe' => ['html']]
        );

        return $filters;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return 'FireflyIII\Support\Twig\Translation';
    }
}

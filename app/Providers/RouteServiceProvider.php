<?php
declare(strict_types = 1);

namespace FireflyIII\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

/**
 * Class RouteServiceProvider
 *
 * @package FireflyIII\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'FireflyIII\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(
            ['namespace' => $this->namespace], function (Router $router) {
            /** @noinspection PhpIncludeInspection */
            require app_path('Http/routes.php');
        }
        );
    }
}

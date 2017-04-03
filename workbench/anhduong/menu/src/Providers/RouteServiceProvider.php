<?php
namespace Anhduong\Menu\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Anhduong\Menu\Http\Controllers';

    /**
     * [map description]
     * @return [type] [description]
     */
    public function map()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../../routes/web.php');

        Route::prefix(config('webed.api_route', 'api'))
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/../../routes/api.php');
    }
}
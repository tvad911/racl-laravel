<?php
namespace Anhduong\Menu;

use Illuminate\Support\ServiceProvider;

/**
 * MenuServiceProvider
 *
 * @package Anhduong\Menu
 * @author  <>
 */
class MenuServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        // $packageRoutesPath       = __DIR__ . '/../../routes/web.php';
        $packageConfigPath       = __DIR__.'/../config/menu.php';
        $packageMigrationsPath   = __DIR__.'/../migrations/';
        $packageAssetsPath       = __DIR__ . '/../resources/assets';
        $packageTranslationsPath = __DIR__ . '/../resources/lang';
        $packageViewsPath        = __DIR__ . '/../resources/views';

        /**
         * Loading package's routes and controllers
         */
        // include $packageRoutesPath;

        /**
         * Loading and publishing package's config
         */
        $config = config_path('menu.php');

        if (file_exists($config)) {
            $this->mergeConfigFrom($packageConfigPath, 'menu');
        }

        $this->publishes([
            $packageConfigPath => $config,
        ], 'config');

        /**
         * Loading and publishing package's translations
         */
        $this->loadTranslationsFrom($packageTranslationsPath, 'menu');

        $this->publishes([
            $packageTranslationsPath => resource_path('lang/vendor/menu'),
        ], 'lang');

        /**
         * Loading and publishing package's views
         */
        $this->loadViewsFrom($packageViewsPath, 'menu');

        $this->publishes([
            $packageViewsPath => resource_path('views/vendor/menu'),
        ], 'views');

        /**
         * Publishing package's assets (JavaScript, CSS, images...)
         */
        $this->publishes([
            $packageAssetsPath => public_path('vendor/menu'),
        ], 'public');

        /**
         * Loading and publishing package's migrations
         */
        $this->loadMigrationsFrom($packageMigrationsPath);

        $this->publishes([
            $packageMigrationsPath => database_path('/migrations')
        ], 'migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('menu', function($app)
        {
            return new Menu();
        });

        $this->app->register('Anhduong\Menu\Providers\RouteServiceProvider');

        $this->app->bind(\Anhduong\Menu\Repositories\MenuRepository::class, \Anhduong\Menu\Repositories\MenuRepositoryEloquent::class);
        //:end-bindings:
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['menu'];
    }

}
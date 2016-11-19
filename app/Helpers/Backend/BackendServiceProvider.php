<?php
namespace App\Helpers\Backend;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('backend', function()
		{
		    return new \App\Helpers\Backend\Backend;
		});
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
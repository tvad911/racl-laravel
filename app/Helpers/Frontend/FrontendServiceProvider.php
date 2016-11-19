<?php
namespace App\Helpers\Frontend;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

class FrontendServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('frontend', function()
		{
		    return new \App\Helpers\Frontend\Frontend;
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
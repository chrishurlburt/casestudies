<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Filter;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Contracts\FilterInterface', function(){

            return new Filter();

        });
    }
}

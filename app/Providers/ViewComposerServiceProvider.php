<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Sentinel;
use \Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->userRole();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function userRole()
    {
        view()->composer('layouts.admin.partials._nav', function($view) {
            $view->with('role', Sentinel::findById(Auth::user()->id)->roles()->first());
        });
    }
}

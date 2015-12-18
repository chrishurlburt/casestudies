<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Sentinel;
use \Auth;
use App\User;

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
        $this->userNotifications();
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

    private function userNotifications()
    {
        view()->composer('layouts.admin.partials._nav', function($view) {
            $view->with('notifications', Auth::user()->notifications()->latest()->take(5)->get());
        });
    }
}




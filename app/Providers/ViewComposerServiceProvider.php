<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Sentinel;
use \Auth;
use App\User;
use App\Outcome;
use App\Course;

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
        $this->dashboardNotifications();
        $this->filterOptions();
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

            $user = $this->prepareUserNotifications();

            $view->with('user', $user);
        });
    }

    private function dashboardNotifications()
    {
        view()->composer('layouts.admin.dashboard', function($view) {

            $user = $this->prepareUserNotifications();

            $view->with('user', $user);

        });
    }

    private function filterOptions()
    {
        view()->composer('layouts.app.results', function($view) {
            $outcomes = Outcome::latest()->get()->all();
            $courses = Course::latest()->get()->all();

            $view->with('outcomes', $outcomes)->with('courses', $courses);
        });
    }

    private function prepareUserNotifications()
    {
        return User::withTrashed()->where('id', Auth::user()->id)->with('notifications')->first();
    }

}




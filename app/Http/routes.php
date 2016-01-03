<?php

/*
|-----------------------------------
| Admin Dashboard Routes
|-----------------------------------
|
| These routes are only accessible by an authenticated
| user and must appear before the app routes to
| avoid wildcard route conflicts.
|
*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);
    Route::get('cases/drafts', ['as' => 'admin.cases.drafts', 'uses' => 'StudiesController@drafts']);

    route::get('notifications', ['as' => 'admin.notifications', 'uses' => 'AdminController@notifications']);
    route::delete('notifications', ['as' => 'admin.notifications.destroy', 'uses' => 'AdminController@destroyNotification']);

    Route::resource('cases', 'StudiesController');
    Route::resource('outcomes', 'OutcomesController');
    Route::resource('courses', 'CoursesController');
    Route::resource('users', 'UsersController');
});


/*
|-----------------------------------
| App Routes
|-----------------------------------
|
| These routes are accessible to any user visiting the
| site and are used for general interaction with
| the application.
|
*/
Route::get('/', ['as' => 'app.landing', 'uses' => 'AppController@index']);
Route::post('/results', ['as' => 'app.search', 'uses' => 'AppController@search']);


/*
|-----------------------------------
| Built-in authentication routes
|-----------------------------------
|
| Routes point to auth controllers.
|
*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


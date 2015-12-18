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
    Route::resource('classes', 'CoursesController');
    Route::resource('users', 'UsersController');
});

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

Route::get('/', ['as' => 'home', 'uses' => 'AppController@index']);

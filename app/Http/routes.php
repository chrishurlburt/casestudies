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
    Route::get('cases', ['as' => 'admin.studies', 'uses' => 'AdminController@studies']);
    Route::get('cases/new', ['as' => 'admin.studies.new', 'uses' => 'AdminController@newstudy']);

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


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'AppController@index']);
Route::get('/{filter}', ['as' => 'home.filter', 'uses' => 'AppController@filter']);
Route::get('/case/{slug}', ['as' => 'home.casestudy', 'uses' => 'AppController@study']);


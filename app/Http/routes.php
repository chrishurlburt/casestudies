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

    Route::get('cases', ['as' => 'admin.studies', 'uses' => 'StudiesController@index']);
    Route::get('cases/new', ['as' => 'admin.studies.create', 'uses' => 'StudiesController@create']);
    Route::get('cases/case/{slug}', ['as' => 'admin.studies.update', 'uses' => 'StudiesController@update']);

    Route::get('courses', ['as' => 'admin.courses', 'uses' => 'CoursesController@index']);
    Route::get('courses/new', ['as' => 'admin.courses.create', 'uses' => 'CoursesController@create']);
    Route::get('courses/course/{slug}', ['as' => 'admin.courses.update', 'uses' => 'CoursesController@update']);

    Route::get('outcomes', ['as' => 'admin.outcomes', 'uses' => 'OutcomesController@index']);
    Route::get('outcomes/new', ['as' => 'admin.outcomes.create', 'uses' => 'OutcomesController@create']);
    Route::get('outcomes/outcome/{slug}', ['as' => 'admin.outcomes.update', 'uses' => 'OutcomesController@update']);

    /*
    |-----------------------------------
    | Admin POST, UPDATE, and DELETE routes
    |-----------------------------------
    |
    | These routes are for adding, updating and deleting
    | new cases, keywords and outcomes.
    |
    */

    Route::post('cases', ['as' => 'admin.studies.store', 'uses' => 'StudiesController@store']);

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
Route::get('studies', ['as' => 'home.studies', 'uses' => 'AppController@studies']);
Route::get('/{filter}', ['as' => 'home.filter', 'uses' => 'AppController@filter']);
Route::get('/case/{slug}', ['as' => 'home.casestudy', 'uses' => 'AppController@study']);


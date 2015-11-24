<?php

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
Route::get('/case/{slug}', ['as' => 'home.casestudy', 'uses' => 'AppController@casestudy']);

Route::get('/admin/cases/add','AdminController@addstudy');
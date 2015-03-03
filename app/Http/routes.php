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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// middlewares within constructors
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/admin', 'Admin\AdminController@getIndex');

Route::group(['middleware' => array('auth', 'admin'), 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::controller('user', 'UserController');
});


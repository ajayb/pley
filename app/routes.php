<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get('/', 'HomeController@home');
Route::get('login', 'HomeController@home');

# User Management
Route::get('users/register', 'UsersController@getRegister');
Route::post('users/create', 'UsersController@postCreate');
Route::get('users/login', 'UsersController@getLogin');
Route::post('users/signin', 'UsersController@postSignin');
Route::get('users/dashboard', 'UsersController@getDashboard');
Route::get('users/logout', 'UsersController@getLogout');
Route::get('thankyou', 'UsersController@getThankyou');
Route::get('users/error', 'UsersController@getError');

# For Testing 
Route::get('users/test', 'UsersController@getTest');
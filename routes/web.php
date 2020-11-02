<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/v1/user/create','UsersController@create_account');
Route::post('/v1/user/delete','UsersController@delete_account');
Route::post('/v1/user/pwd/change','UsersController@update_password');
Route::post('/v1/user/login','UsersController@validate_login');

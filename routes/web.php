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







Route::group(['namespace' => 'App\Http\Controllers\User', 'middleware'=>'admin', 'prefix' => 'user'], function() {

    Route::get('/', 'DashboardController@index')->name('user.index');


  });

  Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'AdminAuth\LoginController@login');
  });

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('booking','Api\BookingController@index');
Route::get('booking/{id}','Api\BookingController@show');
Route::post('booking','Api\BookingController@create');
Route::post('booking/{id}','Api\BookingController@update');
Route::post('booking-status/{id}','Api\BookingController@changeStatus');
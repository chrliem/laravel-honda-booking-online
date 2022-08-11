<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\BookingAdded;

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


Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::group(['middleware'=>'auth:api'], function(){
    // Route::post('register', 'Api\AuthController@register');
    Route::get('booking','Api\BookingController@index');
    Route::get('booking/{id}','Api\BookingController@show');
    Route::get('booking-filtered/{id}','Api\DealerController@show');
    Route::post('booking/{id}','Api\BookingController@update');
    Route::post('booking-status/{id}','Api\BookingController@changeStatus');
    Route::get('booking-log','Api\BookingController@getBookingLog');
    Route::get('user','Api\UserController@index');
    Route::post('user-password/{id}','Api\UserController@changePassword');
    Route::delete('user/{id}','Api\UserController@delete');
    Route::get('wa-instance','Api\WhatsappInstanceController@index');
    Route::post('wa-instance/{id}','Api\WhatsappInstanceController@edit');
    Route::post('wa-instance','Api\WhatsappInstanceController@create');
    Route::delete('wa-instance/{id}','Api\WhatsappInstanceController@delete');
    Route::get('wa-template','Api\WhatsappTemplateController@index');
    Route::post('wa-template/{id}','Api\WhatsappTemplateController@edit');
    Route::post('wa-template','Api\WhatsappTemplateController@create');
    Route::delete('wa-template/{id}','Api\WhatsappTemplateController@delete');
});

Route::post('booking','Api\BookingController@create');
Route::get('dealer','Api\DealerController@index');
Route::get('dealer/{id}','Api\DealerController@getDealer');
Route::get('kendaraan','Api\KendaraanController@index');
Route::get('kendaraan/{id}','Api\KendaraanController@getKendaraan');

// Uncomment untuk testing layout email
// Route::get('notification-email', function(){
//     $nama = 'Christian';
//     $data = [
//         'kode_booking'=>'HSB.2607.XXXXXX',
//         'nama_customer'=>'Christian',
//         'email_customer'=>'christian@gmail.com',
//         'no_handphone'=>'08123243232',
//         'no_polisi'=> 'AD1323WB',
//         'model_kendaraan'=>'New Honda Brio',
//         'jenis_transmisi'=>'Automatic',
//         'kode_dealer'=>'HSB',
//         'nama_dealer'=>'Honda Solo Baru',
//         'tgl_service'=>'2022-07-27 13:00',
//         'jenis_pekerjaan'=>'Authorized Workshops',
//         'jenis_layanan'=>'Quick Maintenance',
//         'keterangan_customer'=>'Tidak ada'
//     ];

//     return new App\Mail\NotificationEmail($data, $nama);
// });
<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/transfer', 'TransferController@index')->name('transfer');
Route::get('api/bill', 'Api\BillController@index')->name('apibill');
Route::get('api/transfer', 'Api\TransferController@gettransfer')->name('gettransfer');
Route::post('api/transfer', 'Api\TransferController@posttransfer')->name('posttransfer');
Route::put('api/transfer/{id}', 'Api\TransferController@confirmtransfer')->name('confirmtransfer');

Route::delete('api/transfer/{id}', 'Api\TransferController@deltransfer')->name('deltransfer');
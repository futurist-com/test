<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('bill', 'Api\BillController@index')->name('apibill');
Route::middleware('auth:api')->get('transfer', 'Api\TransferController@gettransfer')->name('gettransfer');
Route::middleware('auth:api')->post('transfer', 'Api\TransferController@posttransfer')->name('posttransfer');
Route::middleware('auth:api')->put('transfer/{id}', 'Api\TransferController@confirmtransfer')->name('confirmtransfer');
Route::middleware('auth:api')->delete('transfer/{id}', 'Api\TransferController@deltransfer')->name('deltransfer');
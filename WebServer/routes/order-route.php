<?php

use Illuminate\Http\Request;
Route::group(['prefix' => 'web', 'middleware' => ['web','auth']], function () {
    Route::get('/goimon', [
        'as'=>'goimon',
        'uses' => 'OrderController@goimon']);
    Route::get('/order/{id}', [
	'as'=>'order',
    'uses' => 'OrderController@order']);

    Route::post('giohang/capnhat/{id}', [
        'as'=>'capnhat',
        'uses' => 'OrderController@capnhat']);
    Route::get('giohang/xoa/{id}', [
	'as'=>'xoa',
    'uses' => 'OrderController@xoa']);
    Route::post('order/{id}', [
        'as'=>'luuhoadon',
        'uses' => 'OrderController@luuhoadon']);
    Route::post('capnhatorder/{id}', [
        'as'=>'updatehoadon',
        'uses' => 'OrderController@updatehoadon']);
    
});

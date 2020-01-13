<?php

use Illuminate\Http\Request;
Route::group(['prefix' => 'web', 'middleware' => ['web','auth']], function () {
    /**
     * Route get all thanh_vien
     */
    Route::get('/', [
        'as'=>'nhap',
        'uses' =>'NhapController@index'
    ]);
    /**
     * Route get a thanh_vien
     */
    Route::get('/create', [
        'as'=>'createnhap',
        'uses' =>'NhapController@create'
    ]);
    Route::get('/{id}', 'NhapController@show');
    /**
     * Route create new thanh_vien
     */
    Route::post('/create', [
        'as'=>'themnhap',
        'uses' =>'NhapController@store'
    ]);
});
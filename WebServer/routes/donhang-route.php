<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'web', 'middleware' => ['web','auth']], function () {
    /**
     * Route get all thanh_vien
     */
    Route::get('/', [
        'as'=>'donhang',
        'uses' =>'DonhangController@index'
    ]);
    /**
     * Route get a thanh_vien
     */
    
    
});
Route::group(['prefix'=>'api','middleware' => 'jwt.auth'],function(){
	Route::get('/', 'SanphamController@indexAPI');

    //Route::get('/', 'BanController@indexAPI');
});


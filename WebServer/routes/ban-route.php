<?php

use Illuminate\Http\Request;

Route::group(['prefix'=>'web','middleware'=>['web','auth']],function(){
	Route::get('/', [
		'as'=>'ban',
		'uses' =>'BanController@index'
	]);
	// Route::get('/', 'BanController@index');
	/**
	 * Route get a thanh_vien
	 */
	Route::get('/{id}', 'BanController@show');
	/**
	 * Route create new thanh_vien
	 */
	Route::post('/create',[
		'as'=>'themban',
		'uses' =>'BanController@store'
	]);
	/**
	 * Route update a thanh_vien
	 */
	// Route::put('/update/{id}', 'BanController@update');
	/**
	 * Route delete a thanh_vien
	 */
	Route::get('/remove/{id}',[
		'as'=> 'xoaban',
		'uses'=> 'BanController@destroy'
	]);
	Route::get('/datrong/{id}',[
		'as'=> 'datrong',
		'uses'=> 'BanController@datrong'
	]);
});

Route::group(['prefix'=>'api','middleware' => 'jwt.auth'],function(){
	Route::get('/', 'BanController@indexAPI');

    //Route::get('/', 'BanController@indexAPI');
});

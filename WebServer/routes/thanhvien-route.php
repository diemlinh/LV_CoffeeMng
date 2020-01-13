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

// Route::middleware('auth:nv')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=>'api'],function(){
    /**
     * http://localhost:9080/thanhvien/api
     */
    /**
     * Route get all thanh_vien
     */
    Route::get('/get', 'ThanhvienController@index');
    /**
     * Route get a thanh_vien
     */
    Route::get('/get/{ma_tv}', 'ThanhvienController@show');
    /**
     * Route create new thanh_vien
     */
    Route::post('/create', 'ThanhvienController@store');
    /**
     * Route update a thanh_vien
     */
    Route::put('/update/{ma_tv}', 'ThanhvienController@update');
    /**
     * Route delete a thanh_vien
     */
    Route::delete('/remove/{ma_tv}', 'ThanhvienController@remove');

    Route::post('auth/register', 'ThanhvienController@register');
    Route::post('auth/login', 'ThanhvienController@login');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('user-info', 'ThanhvienController@getUserInfo');
    });
});

Route::group(['prefix'=>'web','middleware'=>['web','auth']],function(){
    /**
     * http://localhost:9080/thanhvien/web
     */
    /**
     * Route get all thanh_vien
     * http://localhost:9080/thanhvien/web
     * http://localhost:9080/thanhvien/web/get
     */
    Route::get('/get', 'ThanhvienController@indexWeb');

    Route::get('/', [
        'as'=>'thanhvien',
        'uses' =>'ThanhvienController@index'
    ]);
   
    Route::get('/create', [
        'as'=>'createTv',
        'uses' =>'ThanhvienController@create'
    ]);

    Route::post('/create', [
        'as'=>'themTv',
        'uses' =>'ThanhvienController@store'
    ]);
   
    Route::get('/update/{id}/edit', [
        'as'=>'updateTv',
        'uses' =>'ThanhvienController@edit'
    ]);
    Route::post('/update/{id}',  [
        'as'=>'suaTv',
        'uses' =>'ThanhvienController@update'
    ]);
    /**
     * Route delete a thanh_vien
     */
    Route::post('/remove/{id}', [
        'as'=>'xoaTv',
        'uses' =>'ThanhvienController@destroy'
    ]);
});



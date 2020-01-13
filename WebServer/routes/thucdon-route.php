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

/**
 * http://localhost:9000/thanhvien/
 */
Route::group(['prefix' => 'web', 'middleware' => ['web','auth']], function () {
    /**
     * Route get all thanh_vien
     */
    Route::get('/', [
        'as'=>'thucdon',
        'uses' =>'SanphamController@index'
    ]);
    /**
     * Route get a thanh_vien
     */
    Route::get('/create', [
        'as'=>'createSp',
        'uses' =>'SanphamController@create'
    ]);
    Route::get('/{id}', 'SanphamController@show');
    /**
     * Route create new thanh_vien
     */
    Route::post('/create', [
        'as'=>'themSp',
        'uses' =>'SanphamController@store'
    ]);
    // Route::post('/create', 'SanphamController@store');
    /**
     * Route update a thanh_vien
     */
    Route::get('/update/{id}/edit', [
        'as'=>'updateSp',
        'uses' =>'SanphamController@edit'
    ]);
    Route::post('/update/{id}',  [
        'as'=>'suaSp',
        'uses' =>'SanphamController@update'
    ]);
    /**
     * Route delete a thanh_vien
     */
    Route::post('/remove/{id}', [
        'as'=>'xoaSp',
        'uses' =>'SanphamController@destroy'
    ]);
    Route::get('/theoloai/{id}', [
        'as'=>'theoloai',
        'uses' => 'SanphamController@theoloai']);
    
});
Route::group(['prefix'=>'api','middleware' => 'jwt.auth'],function(){
	Route::get('/', 'SanphamController@indexAPI');

    //Route::get('/', 'BanController@indexAPI');
});


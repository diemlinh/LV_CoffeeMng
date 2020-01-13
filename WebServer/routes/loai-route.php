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
        'as'=>'loai',
        'uses' =>'LoaiController@index'
    ]);
    /**
     * Route get a thanh_vien
     */
    Route::get('/create', [
        'as'=>'createloai',
        'uses' =>'LoaiController@create'
    ]);
    Route::get('/{id}', 'LoaiController@show');
    /**
     * Route create new thanh_vien
     */
    Route::post('/create', [
        'as'=>'themloai',
        'uses' =>'LoaiController@store'
    ]);
    // Route::post('/create', 'LoaiController@store');
    /**
     * Route update a thanh_vien
     */
    Route::get('/update/{id}/edit', [
        'as'=>'updateloai',
        'uses' =>'LoaiController@edit'
    ]);
    Route::post('/update/{id}',  [
        'as'=>'sualoai',
        'uses' =>'LoaiController@update'
    ]);
    /**
     * Route delete a thanh_vien
     */
    Route::post('/remove/{id}', [
        'as'=>'xoaloai',
        'uses' =>'LoaiController@destroy'
    ]);
});
Route::group(['prefix'=>'api'],function(){
    Route::get('/', 'LoaiController@indexAPI');
});



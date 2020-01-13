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
    Route::get('/', [
        'as'=>'khuyenmai',
        'uses' =>'KhuyenmaiController@index'
    ]);
   
    Route::get('/create', [
        'as'=>'createKm',
        'uses' =>'KhuyenmaiController@create'
    ]);

    Route::post('/create', [
        'as'=>'themKm',
        'uses' =>'KhuyenmaiController@store'
    ]);
   
    Route::get('/update/{id}/edit', [
        'as'=>'updateKm',
        'uses' =>'KhuyenmaiController@edit'
    ]);
    Route::post('/update/{id}',  [
        'as'=>'suaKm',
        'uses' =>'KhuyenmaiController@update'
    ]);
    /**
     * Route delete a thanh_vien
     */
    Route::post('/remove/{id}', [
        'as'=>'xoaKm',
        'uses' =>'KhuyenmaiController@destroy'
    ]);
    // Chi tiết khuyến mãi
    Route::get('/chitiet/{id}', [
        'as'=>'chitietkm',
        'uses' =>'ChitietkhuyenmaiController@index'
    ]);
     // Hiển thị form chi tiết khuyến mãi
     Route::get('chitiet/create/{id}', [
        'as'=>'createCtkm',
        'uses' =>'ChitietkhuyenmaiController@create'
    ]);
     // Tạo chi tiết //Lưu csdl
     Route::post('chitiet/create', [
        'as'=>'themCtkm',
        'uses' =>'ChitietkhuyenmaiController@store'
    ]);
    Route::get('chitiet/update/{id}/edit', [
        'as'=>'updateCtkm',
        'uses' =>'ChitietkhuyenmaiController@edit'
    ]);
    Route::post('chitiet/update/{id}',  [
        'as'=>'suaCtkm',
        'uses' =>'ChitietkhuyenmaiController@update'
    ]);
    /**
     * Route delete a thanh_vien
     */
    Route::post('chitiet/remove/{id}', [
        'as'=>'xoaCtkm',
        'uses' =>'ChitietkhuyenmaiController@destroy'
    ]);


});



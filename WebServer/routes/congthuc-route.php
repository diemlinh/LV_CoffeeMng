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
 * http://localhost:9000/thanhvien/web
 */
Route::group(['prefix' => 'web', 'middleware' => ['web','auth']], function () {
    /**
     * Route get all thanh_vien
     */
    Route::get('/', [
        'as'=>'congthuc',
        'uses' =>'CongthucController@index'
    ]);
    /**
     * Route get a thanh_vien
     */
    Route::get('/create', [
        'as'=>'createCt',
        'uses' =>'CongthucController@create'
    ]);
    Route::get('/{id}', 'CongthucController@show');
    /**
     * Route create new thanh_vien
     */
    Route::post('/create', [
        'as'=>'themCt',
        'uses' =>'CongthucController@store'
    ]);
    // Route::post('/create', 'CongthucController@store');
    /**
     * Route update a thanh_vien
     */
    Route::get('/update/{id}/edit', [
        'as'=>'updateCt',
        'uses' =>'CongthucController@edit'
    ]);
    Route::post('/update/{id}',  [
        'as'=>'suaCt',
        'uses' =>'CongthucController@update'
    ]);
    /**
     * Route delete a thanh_vien
     */
    Route::post('/remove/{id}', [
        'as'=>'xoaCt',
        'uses' =>'CongthucController@destroy'
    ]);
});

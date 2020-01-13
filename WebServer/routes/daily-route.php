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
        'as'=>'daily',
        'uses' =>'DailyController@index'
    ]);
    /**
     * Route get a thanh_vien
     */
    Route::get('/create', [
        'as'=>'createDl',
        'uses' =>'DailyController@create'
    ]);
    Route::get('/{id}', 'DailyController@show');
    /**
     * Route create new thanh_vien
     */
    Route::post('/create', [
        'as'=>'themDl',
        'uses' =>'DailyController@store'
    ]);
    // Route::post('/create', 'DailyController@store');
    /**
     * Route update a thanh_vien
     */
    Route::get('/update/{id}/edit', [
        'as'=>'updateDl',
        'uses' =>'DailyController@edit'
    ]);
    Route::post('/update/{id}',  [
        'as'=>'suaDl',
        'uses' =>'DailyController@update'
    ]);
    /**
     * Route delete a thanh_vien
     */
    Route::post('/remove/{id}', [
        'as'=>'xoaDl',
        'uses' =>'DailyController@destroy'
    ]);
    Route::get('/theotinh/{ten}', [
        'as'=>'theotinh',
        'uses' => 'DailyController@theotinh']);
});

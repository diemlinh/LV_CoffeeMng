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
     * Route get all khach hang
     */
    Route::get('/', 'KhachhangController@index');
    /**
     * Route get a khach hang
     */
    Route::get('/{id}', 'KhachhangController@show');
    /**
     * Route create new khach hang
     */
    Route::post('/create', 'KhachhangController@store');
    /**
     * Route update a khach hang
     */
    Route::put('/update/{id}', 'KhachhangController@update');
    /**
     * Route delete a khach hang
     */
    Route::delete('/remove/{id}', 'KhachhangController@remove');
});



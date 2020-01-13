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
/**
 * Route get all thanh_vien
 */
Route::get('/', 'BbaivietController@index');
/**
 * Route get a thanh_vien
 */
Route::get('/{id}', 'BbaivietController@show');
/**
 * Route create new thanh_vien
 */
Route::post('/create', 'BbaivietController@store');
/**
 * Route update a thanh_vien
 */
Route::put('/update/{id}', 'BbaivietController@update');
/**
 * Route delete a thanh_vien
 */
Route::delete('/remove/{id}', 'BbaivietController@remove');


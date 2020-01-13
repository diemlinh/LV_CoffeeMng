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
    Route::get('/', 'GopyController@index');
    /**
     * Route get a thanh_vien
     */
    Route::get('/{id}', 'GopyController@show');
    /**
     * Route create new thanh_vien
     */
    Route::post('/create', 'GopyController@store');
    /**
     * Route update a thanh_vien
     */
    Route::put('/update/{id}', 'GopyController@update');
    /**
     * Route delete a thanh_vien
     */
    Route::delete('/remove/{id}', 'GopyController@remove');
});



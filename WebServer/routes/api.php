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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/auth/login', 'ThanhvienController@login');
Route::group(['middleware' => 'jwt.auth'],function(){
    Route::get('/loai', 'LoaiController@indexAPI');
    Route::get('/sanpham', 'SanphamController@indexAPI');
    Route::get('/ban', 'BanController@indexAPI');
    // Route::get('user-info', 'ThanhvienController@getUserInfo');
    Route::get('/getUserInfo', 'ThanhvienController@getUserInfo');
    Route::get('/hoadon/{id}', 'OrderController@hoadonAPI');
    Route::get('/chitiethoadon/{id}', 'OrderController@chitiethoadonAPI');
    Route::post('/goimon/{id}', 'OrderController@luuhoadonAPI');
    Route::post('/themmon/{ma_ban}', 'OrderController@themgiohangAPI');
    Route::post('/capnhatSL/{id}', 'OrderController@capnhatSLAPI');
    Route::post('/capnhat/{id}', 'OrderController@capnhatAPI');
    Route::get('/xoagiohang/{id}', 'OrderController@xoagiohangAPI');
    Route::post('/thanhtoan', 'HoadonController@thanhtoanAPI');
    Route::put('/datrong/{id}', 'BanController@edit');
    Route::get('/getSolgPhacheTrongHD/{hoadonId}/{sanphamId}', 'OrderController@getSolgPhacheTrongHD');

}); 
    

//http://localhost:9000/api/hello-world
Route::get('/hello-world', function(Request $request){
    return response()->json('Hello World!',200);
});
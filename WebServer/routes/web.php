<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dangnhap', function () {
	return view('admin.login');
});
Route::group(['middleware' => ['web','auth']],function(){
    Route::get('/quantri', [
        'as'=>'quantri',
        'uses' =>'PageController@getAdmin'
    ]);
    // Route::get('/quantri/index', 'PageController@getIndex');

});
//Đăng nhập
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);

// Đăng xuất
Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);

Route::get('/showNotification', function () {
    return view('showNotification');
});

Route::get('getPusher', function (){
    return view('form_pusher');
 });
 
 Route::get('/pusher', function(Illuminate\Http\Request $request) {
     event(new App\Events\DemoPusherEvent($request));
     return redirect('getPusher');
 });
//  Route::get('header','FrontEndController@getPusher');
// // Truyển message lên server Pusher
//  Route::get('fire-event','FrontEndController@fireEvent');

<?php

use Illuminate\Http\Request;

Route::group(['prefix'=>'api'],function(){
    /**
     * http://localhost:9080/thanhvien/api
     */

});

Route::group(['prefix'=>'web','middleware' => ['web','auth']],function(){
    /**
     * http://localhost:9080/thanhvien/web
     */
    /**
     * Route get all thanh_vien
     * http://localhost:9080/thanhvien/web
     * http://localhost:9080/thanhvien/web/get
     */
    Route::get('/get', 'ThanhvienController@indexWeb');
    



    ////////////////////////////////////////// GIO HANG ///////////////////////////////////////////////////////
    Route::get('/giohangban/{maban}', 'GiohangController@showGiohangban');

    /// HOA DON///
    Route::get('hoadon/{id}', [
        'as'=>'xuathoadon',
        'uses' => 'HoadonController@xuathoadon']);
    Route::get('xemhoadon/{id}', [
        'as'=>'xemhoadon',
        'uses' => 'HoadonController@xemhoadon']);    
    Route::post('thanhtoan/{id}', [
        'as'=>'thanhtoan',
        'uses' => 'HoadonController@thanhtoan']);
    // Route::get('bill', [
    //         'as'=>'bill',
    //         'uses' => 'HoadonController@thanhtoan']);
    Route::get('bill', function () {
        return view('admin.hoadon.bill')->name('bill');
    });
});

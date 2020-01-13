<?php

use Illuminate\Http\Request;
Route::group(['prefix' => 'web', 'middleware' => ['web','auth']], function () {
    Route::get('/', [
        'as'=>'phache',
        'uses' => 'PhacheController@index']);
    
    Route::get('/dataphache',[
        'as'=>'dataphache',
        'uses' => 'PhacheController@dataindex']);
    
    Route::get('/data/datachuapha',[
        'as'=>'datachuapha',
        'uses' => 'PhacheController@datachuapha']);

    Route::get('/data/datadapha',[
        'as'=>'datadapha',
        'uses' => 'PhacheController@datadapha']);

    Route::get('/data/datatonghop',[
        'as'=>'datatonghop',
        'uses' => 'PhacheController@datatonghop']);

    Route::get('/toDapha/{ma_hoa_don}/{ma_sp}/{so_luong}', [
        'uses' => 'PhacheController@dapha']);
    
    Route::get('/toChuapha/{ma_hoa_don}/{ma_sp}/{so_luong}', [
        'uses' => 'PhacheController@chuapha']);
});

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
    // return view('welcome');
});

Route::group(['prefix' => '/tahun_ajaran', 'as' => 'tahun_ajaran.'], function() {
    Route::get('/index', 'TahunAjaranController@index')->name('index');
    Route::post('/create', 'TahunAjaranController@create')->name('create');
    Route::delete('/delete/{tahun_ajaran}', 'TahunAjaranController@delete')->name('delete');
    Route::get('/edit/{tahun_ajaran}', 'TahunAjaranController@edit')->name('edit');
    Route::post('/update/{tahun_ajaran}', 'TahunAjaranController@update')->name('update');
});
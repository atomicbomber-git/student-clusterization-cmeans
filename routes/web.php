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

Route::redirect('/', '/tahun_ajaran/index');

Route::group(['prefix' => '/tahun_ajaran', 'as' => 'tahun_ajaran.'], function() {
    Route::get('/index', 'TahunAjaranController@index')->name('index');
    Route::post('/create', 'TahunAjaranController@create')->name('create');
    Route::delete('/delete/{tahun_ajaran}', 'TahunAjaranController@delete')->name('delete');
    Route::get('/edit/{tahun_ajaran}', 'TahunAjaranController@edit')->name('edit');
    Route::post('/update/{tahun_ajaran}', 'TahunAjaranController@update')->name('update');
});

Route::group(['prefix' => '/angkatan', 'as' => 'angkatan.'], function() {
    Route::get('/index', 'AngkatanController@index')->name('index');
    Route::post('/create', 'AngkatanController@create')->name('create');
    Route::delete('/delete/{angkatan}', 'AngkatanController@delete')->name('delete');
    Route::get('/edit/{angkatan}', 'AngkatanController@edit')->name('edit');
    Route::post('/update/{angkatan}', 'AngkatanController@update')->name('update');
});

Route::group(['prefix' => '/mahasiswa', 'as' => 'mahasiswa.'], function() {
    Route::get('/index', 'MahasiswaController@index')->name('index');
    Route::post('/create', 'MahasiswaController@create')->name('create');
    Route::delete('/delete/{mahasiswa}', 'MahasiswaController@delete')->name('delete');
    Route::get('/edit/{mahasiswa}', 'MahasiswaController@edit')->name('edit');
    Route::post('/update/{mahasiswa}', 'MahasiswaController@update')->name('update');
});

Route::group(['prefix' => '/nilai', 'as' => 'nilai.'], function() {
    Route::get('/index', 'NilaiController@index')->name('index');

    $nilai_detail_prefix = '/detail/{tahun_ajaran}/{ganjil_genap}/{angkatan}';
    Route::group(['prefix' => $nilai_detail_prefix, 'as' => 'detail.'], function() {
        Route::get('/index', 'NilaiDetailController@index')->name('index');
        Route::post('/update', 'NilaiDetailController@update')->name('update');
    });
});
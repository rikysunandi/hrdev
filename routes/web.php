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



Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/dashboard/get_data', 'HomeController@getDashboardData');
Route::get('/dashboard/get_mutasi_terbaru', 'HomeController@getMutasiTebaru');
Route::get('/dashboard/get_pensiun_terbaru', 'HomeController@getPensiunTebaru');
Route::get('/organisasi/chart', 'OrganisasiController@chart');
Route::get('/organisasi/get_ko1', 'OrganisasiController@getKO1');
Route::get('/organisasi/get_ko2/{ko_1}', 'OrganisasiController@getKO2');
Route::get('/organisasi/get_ko3/{ko_2}', 'OrganisasiController@getKO3');
Route::get('/organisasi/get_ko4/{ko_3}', 'OrganisasiController@getKO4');
Route::get('/organisasi/get_chart_data', 'OrganisasiController@getChartData');
Route::get('/karir/posisi-kosong', 'KarirController@posisiKosong');
Route::get('/karir/posisi-kosong/get-data', 'KarirController@getPosisiKosongData');
Route::get('{any}', 'LexaController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* fitproper */

Route::get('/fitpro/mBidang', 'FitproController@mBidang');
Route::get('/fitpro/mBidang/get-data', 'FitproController@getmBidangData');
Route::get('/fitpro/mSoftKompetensi', 'FitproController@mSoftKompetensi');
Route::get('/fitpro/mSoftKompetensi/get-data', 'FitproController@getmSoftKompetensiData');
Route::get('/fitpro/mKompetensi', 'FitproController@mKompetensi');
Route::get('/fitpro/mKompetensi/get-data', 'FitproController@getmKompetensiData');
Route::get('/fitpro/mKeyBehaviour', 'FitproController@mKeyBehaviour');
Route::get('/fitpro/mKeyBehaviour/get-data', 'FitproController@getmKeyBehaviourData');
//Route::get('/karir/posisi-kosong/get-data', 'KarirController@getPosisiKosongData');
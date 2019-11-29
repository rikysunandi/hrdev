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
Route::get('/orgchart', 'OrgChartController@index');
Route::get('{any}', 'LexaController@index');

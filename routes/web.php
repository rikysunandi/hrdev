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

Route::get('/', function() {
    return redirect(route('login'));
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    Route::get('setPassword', 'Auth\VerificationController@show')->name('set.password');
    Route::post('setPassword', 'Auth\VerificationController@setPassword')->name('set.password');
    Route::group(['middleware' => 'account'], function() {
        Route::group(['middleware' => ['role:admin']], function () {
            Route::resource('/role', 'RoleController')->except([
                'create', 'show', 'edit', 'update'
            ]);

            Route::resource('/users', 'UserController')->except([
                'show'
            ]);
            Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
            Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
            Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
            Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
            Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
        });

        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/set-session', 'HomeController@setSession');
        Route::get('/data/get-pegawai', 'HomeController@getPegawai');
        Route::get('/dashboard/get_data', 'HomeController@getDashboardData');
        Route::get('/dashboard/get_mutasi_terbaru', 'HomeController@getMutasiTebaru');
        Route::get('/dashboard/get_pensiun_terbaru', 'HomeController@getPensiunTebaru');
        Route::post('/organisasi/chart', 'OrganisasiController@chart');
        Route::get('/organisasi/chart', 'OrganisasiController@chart');
        Route::get('/organisasi/get_chart_data', 'OrganisasiController@getChartData');
        Route::get('/referensi/get_ko1', 'ReferensiController@getKO1');
        Route::get('/referensi/get_ko2/{ko_1}', 'ReferensiController@getKO2');
        Route::get('/referensi/get_ko3/{ko_2}', 'ReferensiController@getKO3');
        Route::get('/referensi/get_ko4/{ko_3}', 'ReferensiController@getKO4');

        Route::get('/karir/posisi-kosong', 'Karir\PosisiKosongController@index')->name('posisi.kososng');
        Route::get('/karir/posisi-kosong/get-data', 'Karir\PosisiKosongController@getData');
        Route::post('/karir/daftar-kandidat/show', 'Karir\KandidatController@show')->name('daftar.kandidat');
        Route::post('/karir/daftar-kandidat/store', 'Karir\KandidatController@store')->name('daftar.kandidat.store');
        Route::get('/karir/plt', 'Karir\PLTController@index');
        Route::get('/karir/plt/get-data', 'Karir\PLTController@getData');
        Route::get('/karir/lama-menjabat', 'Karir\LamaMenjabatController@index');
        Route::get('/karir/lama-menjabat/get-data', 'Karir\LamaMenjabatController@getData');
        Route::get('/karir/akan-pensiun', 'Karir\StrukturalPensiunController@index');
        Route::get('/karir/akan-pensiun/get-data', 'Karir\StrukturalPensiunController@getData');

        Route::post('/profile', 'Administrasi\ProfileController@index');
        Route::get('/profile', 'Administrasi\ProfileController@index');
        Route::get('/profile/get-data/{prev_per_no}', 'Administrasi\ProfileController@getData');
        Route::get('/profile/get-pendidikan/{prev_per_no}', 'Administrasi\ProfileController@getPendidikan');
        Route::get('/profile/get-rjab/{prev_per_no}', 'Administrasi\ProfileController@getRJab');
        Route::get('/profile/get-talenta/{prev_per_no}', 'Administrasi\ProfileController@getTalenta');

        Route::get('{any}', 'LexaController@index');

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
    });
});


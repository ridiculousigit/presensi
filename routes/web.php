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
  return view('auth.login');
});
Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);

// Rute untuk proses logout
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Rute untuk halaman dashboard
Route::get('/dashboard', 'HomeController@index')->name('home');

// Rute untuk pengelolaan data kelas
Route::get('/datakelas/index', 'Backend\KelasController@index')->name('indexKelas');
Route::post('/datakelas/post', 'Backend\KelasController@store')->name('storeKelas');
Route::post('/datakelas/edit', 'Backend\KelasController@edit')->name('editKelas');
Route::post('/datakelas/update', 'Backend\KelasController@update')->name('updateKelas');
Route::get('/datakelas/delete/{id}', 'Backend\KelasController@destroy')->name('destroyKelas');

// Rute untuk pengelolaan data materi
Route::get('/datamateri/index', 'Backend\MateriController@index')->name('indexMateri');
Route::post('/datamateri/post', 'Backend\MateriController@store')->name('storeMateri');
Route::post('/datamateri/edit', 'Backend\MateriController@edit')->name('editMateri');
Route::post('/datamateri/update', 'Backend\MateriController@update')->name('updateMateri');
Route::get('/datamateri/delete/{id}', 'Backend\MateriController@destroy')->name('destroyMateri');

// Rute untuk pengelolaan data asisten
Route::get('/dataasisten/index', 'Backend\AsistenController@index')->name('indexAsisten');
Route::post('/dataasisten/post', 'Backend\AsistenController@store')->name('storeAsisten');
Route::post('/dataasisten/edit', 'Backend\AsistenController@edit')->name('editAsisten');
Route::post('/dataasisten/update', 'Backend\AsistenController@update')->name('updateAsisten');
Route::get('/dataasisten/destroy/{id}', 'Backend\AsistenController@destroy')->name('destroyAsisten');

// Rute untuk pengelolaan kode
Route::get('/generator/index', 'Backend\KodeController@index')->name('indexKode');
Route::post('/generator/post', 'Backend\KodeController@store')->name('storeKode');

// Rute untuk proses absensi
Route::post('/absen/post', 'Backend\AbsenController@store')->name('storeAbsen');
Route::post('/absen/update', 'Backend\AbsenController@update')->name('updateAbsen');

// Rute untuk riwayat absensi
Route::get('/riwayat/index', 'Backend\RiwayatController@index')->name('indexRiwayat');
Route::get('/riwayat/report', 'Backend\RiwayatController@report')->name('reportRiwayat');
Route::post('/riwayat/cari', 'Backend\RiwayatController@search')->name('searchRiwayat');

// Rute untuk pengelolaan profil pengguna
Route::get('/user/profile/{id}', 'Backend\AsistenController@editProfile')->name('editProfile');

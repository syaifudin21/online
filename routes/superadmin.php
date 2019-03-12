<?php

//  PENGGUNAAN NAME ROUTE HARUS DIGUNAKAN
// ->name('auth.menu.metode')
// home = tampil semua
// create = form tambah
// show = tampil per id
// store = post masuk
// edit = form edit
// update = put update
// delete = delete hapus

Route::get('/', 'superadmin\HomeController@index')->name('superadmin.home');
Route::get('/login', 'superadmin\LoginController@form')->name('superadmin.form.login');
Route::post('/login', 'superadmin\LoginController@login')->name('superadmin.login');
Route::post('/logout', 'superadmin\LoginController@logout')->name('superadmin.logout');
Route::get('/profil', 'superadmin\ProfilController@profil')->name('superadmin.profil');

Route::get('/kurikulum', 'superadmin\KurikulumController@index')->name('superadmin.kurikulum.home');
Route::get('/kurikulum/tambah', 'superadmin\KurikulumController@create')->name('superadmin.kurikulum.create');
Route::post('/kurikulum/tambah', 'superadmin\KurikulumController@store')->name('superadmin.kurikulum.store');
Route::get('/kurikulum/edit/{id_kurikulum}', 'superadmin\KurikulumController@edit')->name('superadmin.kurikulum.edit');
Route::put('/kurikulum/update', 'superadmin\KurikulumController@update')->name('superadmin.kurikulum.update');
Route::delete('/kurikulum/delete/{id}', 'superadmin\KurikulumController@delete')->name('superadmin.kurikulum.delete');

Route::get('/kelas/{id_kurikulum}', 'superadmin\KelasController@index')->name('superadmin.kelas.home');
Route::get('/kelas/{id_kurikulum}/tambah', 'superadmin\KelasController@create')->name('superadmin.kelas.create');
Route::post('/kelas/{id_kurikulum}/tambah', 'superadmin\KelasController@store')->name('superadmin.kelas.store');
Route::get('/kelas/edit/{id_kurikulum}', 'superadmin\KelasController@edit')->name('superadmin.kelas.edit');
Route::put('/kelas/update', 'superadmin\KelasController@update')->name('superadmin.kelas.update');
Route::delete('/kelas/delete/{id}', 'superadmin\KelasController@delete')->name('superadmin.kelas.delete');

Route::get('/mapel/{id_kelas}', 'superadmin\MapelController@index')->name('superadmin.mapel.home');
Route::get('/mapel/{id_kelas}/tambah', 'superadmin\MapelController@create')->name('superadmin.mapel.create');
Route::post('/mapel/{id_kelas}/tambah', 'superadmin\MapelController@store')->name('superadmin.mapel.store');
Route::get('/mapel/edit/{id_kelas}', 'superadmin\MapelController@edit')->name('superadmin.mapel.edit');
Route::put('/mapel/update', 'superadmin\MapelController@update')->name('superadmin.mapel.update');
Route::delete('/mapel/delete/{id}', 'superadmin\MapelController@delete')->name('superadmin.mapel.delete');

Route::get('/bab/{id_mapel}', 'superadmin\BabController@index')->name('superadmin.bab.home');
Route::get('/bab/{id_mapel}/tambah', 'superadmin\BabController@create')->name('superadmin.bab.create');
Route::post('/bab/{id_mapel}/tambah', 'superadmin\BabController@store')->name('superadmin.bab.store');
Route::get('/bab/edit/{id_mapel}', 'superadmin\BabController@edit')->name('superadmin.bab.edit');
Route::put('/bab/update', 'superadmin\BabController@update')->name('superadmin.bab.update');
Route::delete('/bab/delete/{id}', 'superadmin\BabController@delete')->name('superadmin.bab.delete');


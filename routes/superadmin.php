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

Route::get('/tahunajaran', 'superadmin\TahunAjaranController@index')->name('superadmin.ta.home');
Route::get('/tahunajaran/tambah', 'superadmin\TahunAjaranController@create')->name('superadmin.ta.create');
Route::post('/tahunajaran/tambah', 'superadmin\TahunAjaranController@store')->name('superadmin.ta.store');
Route::get('/tahunajaran/edit/{id_ta}', 'superadmin\TahunAjaranController@edit')->name('superadmin.ta.edit');
Route::get('/tahunajaran/{id}', 'superadmin\TahunAjaranController@show')->name('superadmin.ta.show');
Route::put('/tahunajaran/update', 'superadmin\TahunAjaranController@update')->name('superadmin.ta.update');
Route::delete('/tahunajaran/delete/{id}', 'superadmin\TahunAjaranController@delete')->name('superadmin.ta.delete');
Route::get('/tahunajaran/siswa/{id}', 'superadmin\TahunAjaranController@taSiswa')->name('superadmin.ta.siswa');
Route::get('/tahunajaran/siswa/absen/{id}', 'superadmin\TahunAjaranController@absenSiswa')->name('superadmin.ta.tes.absen');
Route::get('/tahunajaran/siswa/belumabsen/{id}', 'superadmin\TahunAjaranController@belumAbsenSiswa')->name('superadmin.ta.belumabsen');
Route::get('/tahunajaran/siswa/testhadir/{id}', 'superadmin\TahunAjaranController@hadirSiswaTest')->name('superadmin.ta.testhadir');
Route::get('/tahunajaran/siswa/testtidakhadir/{id}', 'superadmin\TahunAjaranController@absenSiswaTest')->name('superadmin.ta.testtidakhadir');
Route::get('/tahunajaran/siswa/nilai/{id}', 'superadmin\TahunAjaranController@nilaiSiswa')->name('superadmin.ta.tes.nilai');
Route::post('/tahunajaran/siswa/nilai', 'superadmin\TahunAjaranController@nilaiStore')->name('superadmin.ta.tes.store');
Route::get('/tahunajaran/siswa/nilailock/{id}', 'superadmin\TahunAjaranController@loknilai')->name('superadmin.ta.lock.nilai');
Route::get('/tahunajaran/siswa/daftarulang/{id}', 'superadmin\TahunAjaranController@daftarUlang')->name('superadmin.ta.daftarulang');
Route::post('/tahunajaran/siswa/daftarulang/store', 'superadmin\TahunAjaranController@storeDaftarUlang')->name('superadmin.ta.dddd.store');
Route::get('/tahunajaran/siswa/tempatkan/{id}', 'superadmin\TahunAjaranController@tempatkan')->name('superadmin.ta.tempatkan');
Route::post('/tahunajaran/siswa/tempatkan', 'superadmin\TahunAjaranController@tempatkanstore')->name('superadmin.ta.tempatkan.store');


Route::get('/siswa/{nomor_user}', 'superadmin\SiswaController@show')->name('superadmin.siswa.show');
Route::get('/siswa/status/{id}/{status}', 'superadmin\SiswaController@status')->name('superadmin.siswa.status');
Route::get('/siswa/edit/{id}', 'superadmin\SiswaController@edit')->name('superadmin.siswa.edit');
Route::put('/siswa/update', 'superadmin\SiswaController@update')->name('superadmin.siswa.update');
Route::delete('/siswa/delete/{id}', 'superadmin\SiswaController@delete')->name('superadmin.siswa.delete');

Route::get('/ruangkelas/tambah/{id_ta}', 'superadmin\RuangKelasController@create')->name('superadmin.rk.create');
Route::post('/ruangkelas/tambah', 'superadmin\RuangKelasController@store')->name('superadmin.rk.store');
Route::get('/ruangkelas/edit/{id}', 'superadmin\RuangKelasController@edit')->name('superadmin.rk.edit');
Route::get('/ruangkelas/{id}', 'superadmin\RuangKelasController@show')->name('superadmin.rk.show');
Route::put('/ruangkelas/update', 'superadmin\RuangKelasController@update')->name('superadmin.rk.update');
Route::delete('/ruangkelas/delete/{id}', 'superadmin\RuangKelasController@delete')->name('superadmin.rk.delete');

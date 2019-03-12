<?php

Route::get('/', 'siswa\HomeController@index')->name('siswa.home');
Route::post('/logout', 'siswa\HomeController@logout')->name('siswa.logout');
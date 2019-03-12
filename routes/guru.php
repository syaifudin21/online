<?php

Route::get('/', 'guru\HomeController@index')->name('guru.home');
Route::post('/logout', 'guru\HomeController@logout')->name('guru.logout');
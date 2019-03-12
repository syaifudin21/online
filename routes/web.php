<?php

Route::get('/', 'front\HomeController@index');
Route::get('/index', 'front\HomeController@index')->name('index.home');
Route::get('/login', 'front\HomeController@login')->name('login');

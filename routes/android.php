<?php

Route::group(['prefix' => 'v1'], function () {
    route::post('siswa/login', 'Android\Siswa\LoginController@login');
    route::post('siswa/artikel', 'Android\Siswa\ArtikelController@store');
});
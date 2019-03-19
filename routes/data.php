<?php

Route::get('kurikulum','data\TahunAjaranController@kurikulumkelas')->name('data.kurikulum.kelas');
Route::get('ta/switch', 'data\KurikulumController@switch')->name('data.ta.switch');
Route::get('ta/absen', 'data\KurikulumController@absen')->name('data.ta.absen');
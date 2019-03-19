<?php
// use Image;

set_time_limit(0);

Route::get('/', 'front\HomeController@index');
Route::get('/index', 'front\HomeController@index')->name('index.home');
Route::get('/login', 'front\HomeController@login')->name('login');

Route::get('/daftar', 'front\DaftarController@daftar')->name('siswa.daftar.create');
Route::post('/daftar', 'front\DaftarController@storedaftar')->name('siswa.daftar.store');
Route::get('/cek', 'front\DaftarController@cekdaftar')->name('siswa.cek');

// Route::get('/upload', function()
// {
//     $img = Image::make('images/1552634877.png');
//     $img->resize(100, null, function ($constraint) {
//         $constraint->aspectRatio();
//     });
//     $img->response('png');
//     $img->save('images/bar.jpg', 10);
// });

// Route::get('crop-image', 'CobaController@index');
// Route::post('crop-image', ['as'=>'upload.image','uses'=>'CobaController@uploadImage']);

Route::group(['prefix' => 'api'] , function() {

    Route::post('/login', 'ApiController@postLogin');

    Route::group(['middleware' => ['jwt']], function() {
        Route::get('/user', 'ApiController@getUser');
    });
});
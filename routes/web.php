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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('verifyEmailFirst', 'Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');

Route::get('verify/{email}/{verifyToken}', 'Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::group([ 'prefix' => 'admin'], function()
{
                    //nomb. rutas    //nomb. controlador
    Route::resource('videoplaylist', 'VideosPlaylistController');
    Route::get('videoplaylist/{id}/destroy', [
      'uses' => 'VideosPlaylistController@destroy',
      'as'  => 'admin.videoplaylist.destroy'
   ]);

});

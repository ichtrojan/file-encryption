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

Route::get('upload-file', 'HomeController@index')->name('home');

Route::view('file-upload', 'file-upload');

Route::post('upload-file', 'FileRefController@upload');

Route::get('all', 'FileRefController@listAll');

Route::get('download/{ref}', 'FileRefController@download');

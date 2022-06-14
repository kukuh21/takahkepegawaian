<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','Auth\LoginController@getLoginForm')->name('login');
Route::get('/login','Auth\LoginController@getLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function(){
  Route::get('/home','HomeController@index')->name('dashboard');
  Route::get('/profile','HomeController@profile')->name('profile');
  Route::put('/updateProfile/{id}','HomeController@updateProfile')->name('updateProfile');

  Route::get('/folder/data','FolderController@data')->name('folder.data');
  Route::get('/folder/editJson/{id}','FolderController@editJson')->name('folder.editJson');
  Route::resource('/folder','FolderController');

  Route::get('/fileberkas/{id}','BerkasController@fileberkas')->name('fileberkas');
  Route::get('/berkas/data/{id}','BerkasController@data')->name('berkas.data');
  Route::post('/berkas/storeJson','BerkasController@storeJson')->name('berkas.storeJson');
  Route::get('/berkas/editJson/{id}','BerkasController@editJson')->name('berkas.editJson');
  Route::patch('/berkas/updateJson/{id}','BerkasController@updateJson')->name('berkas.updateJson');
  Route::patch('/berkas/updateNamaJson/{id}','BerkasController@updateNamaJson')->name('berkas.updateNamaJson');
  Route::delete('/berkas/destroy/{id}','BerkasController@destroy')->name('berkas.destroy');

});

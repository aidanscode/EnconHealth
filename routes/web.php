<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
Route::get('/register/post', 'Auth\AuthController@postRegister')->name('register.post');
Route::get('/verify/post', 'Auth\AuthController@postVerify')->name('verify.post');

Route::get('/home', function() {
  return redirect()->route('index');
})->name('home');

Route::group(['middleware' => ['auth', 'verified']], function() {
  Route::get('/', 'AppController@index')->name('index');
  Route::post('/submit-response', 'AppController@submitResponse')->name('response.submit');
});

Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {
  Route::get('/', 'AdminController@index')->name('admin.index');

  Route::get('/configure', 'AdminController@configure')->name('admin.configure');
  Route::post('/configure', 'AdminController@updateConfiguration')->name('admin.configure.store');

  Route::get('/admins', 'AdminController@admins')->name('admin.admins');
});

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'AppController@index')->name('index');

Auth::routes(['verify' => true]);
Route::get('/register/post', 'Auth\AuthController@postRegister')->name('register.post');
Route::get('/verify/post', 'Auth\AuthController@postVerify')->name('verify.post');

Route::get('/home', function() {
  return redirect()->route('index');
})->name('home');

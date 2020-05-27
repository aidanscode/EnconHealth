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
  Route::post('/configure/emails', 'AdminController@updateEmailList')->name('admin.configure.emails');

  Route::get('/responses/day', 'AdminController@byDay')->name('admin.responses.day');
  Route::post('/responses/day', 'AdminController@byDay')->name('admin.responses.day.ajax');

  Route::get('/responses/employee', 'AdminController@byEmployee')->name('admin.responses.employee');
  Route::post('/responses/employee', 'AdminController@byEmployee')->name('admin.responses.employee.ajax');

  Route::get('/admins', 'AdminController@admins')->name('admin.admins');
});

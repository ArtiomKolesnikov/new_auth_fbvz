<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/email-authenticate/{token}', [
    'as' => 'auth.email-authenticate',
    'uses' => 'Auth\LoginController@authenticateEmail'
]);

Route::view('/login_select','auth.login_select')->name('login_select');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

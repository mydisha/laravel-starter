<?php

Route::get('/', function () {
	return view('welcome');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Auth::routes();

// Simple Hack Logout Route
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('/home', 'HomeController@index')->name('home');

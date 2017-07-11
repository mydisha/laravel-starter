<?php

Route::group(['prefix' => 'account'], function () {
	Route::post('auth', [
		'as' => 'auth',
		'uses' => 'Api\Account\AccountController@login',
	]);
});
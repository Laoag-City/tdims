<?php

Route::match(['get', 'post'], '/', 'AuthenticationController@login')->name('login')->middleware('guest');

Route::group(['middleware' => 'auth'], function(){
	Route::match(['get', 'post'], 'drivers', 'DriverController@showAddDriverForm');
	Route::get('drivers/latest-id-no', 'DriverController@getLatestIdNo');

	Route::get('drivers/city', 'DriverController@getCityOrBrgyDrivers');
	Route::get('drivers/barangay', 'DriverController@getCityOrBrgyDrivers');

	Route::get('drivers/{driver}', 'DriverController@showDriverInformation');

	Route::get('drivers/{driver}/edit', 'DriverController@showEditDriverForm');
	Route::put('drivers/{driver}', 'DriverController@editDriverInformation');

	Route::match(['get', 'patch'], 'drivers/{driver}/id-control-no', 'DriverController@manageIDControlNo');

	Route::match(['get', 'patch'], 'drivers/{driver}/lost-id', 'DriverController@changeLostID');

	Route::get('drivers/{driver}/id-printout', 'DriverController@showIdPrintout');
	//Route::get('drivers/{driver}/id-printout-back', 'DriverController@showIdPrintoutBack');

	Route::get('pictures/{driver}', 'DriverController@getPicture');

	Route::delete('drivers/{driver}', 'DriverController@removeDriver');

	Route::get('search-results', 'SearchController');

	Route::match(['get', 'post'],'users', 'UserController@index');
	Route::match(['get', 'patch'], 'users/{user}/edit', 'UserController@editUser');
	Route::delete('users/{user}', 'UserController@removeUser');

	Route::post('logout', 'AuthenticationController@logout');
});
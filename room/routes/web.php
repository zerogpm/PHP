<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

/*
 * To cater for middleware redirect if auth
 */
Route::get('home', function () {
	return redirect('/dashboard');
});

Route::get('register/confirm/{token}', 'Auth\RegisterController@confirmEmail');

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function () {
	Route::get('/events-by-room-id/{id}','ApiController@getEventsByRoomId');
});

Route::group(['middleware' => 'auth', 'prefix' => 'datatables'], function () {
	Route::get('/rooms','DatatablesController@getRooms');
	Route::get('/users','DatatablesController@getUsers');
	Route::get('/all-room-booking','DatatablesController@getAllRoomBooking');
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {
	Route::get('/','DashboardController@index');
	Route::post('/booking/search', 'BookingController@search');
	Route::resource('/booking', 'BookingController');
	Route::resource('/rooms','RoomController');
	Route::resource('/users','UserController');
	Route::get('/change-password','ChangePasswordController@index');
	Route::post('/change-password/{id}','ChangePasswordController@update');
});

Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();

Route::get('install/{seed?}', function ($seed = null) {
	if($seed == null)
	{
		Artisan::call('migrate');
	} else {
		Artisan::call('migrate', ['--seed' => true]);
	}
    return redirect('/login');
});

Route::get('refresh/{seed?}', function ($seed = null) {
	if($seed == null)
	{
		Artisan::call('migrate:refresh');
	} else {
		Artisan::call('migrate:refresh', ['--seed' => true]);
	}
    return redirect('/login');
});

Route::get('clear', function () {
	Artisan::call('view:clear');
	return redirect('/');
});
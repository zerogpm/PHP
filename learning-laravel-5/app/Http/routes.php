<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', 'PagesController@about');
Route::get('contact', 'PagesController@contact');
/**
Route::get('article', 'ArticlesController@index');
Route::get('article/create', 'ArticlesController@create');
Route::get('article/{id}', 'ArticlesController@show');
Route::post('article', 'ArticlesController@store');
**/

/**
 * create resource can replace all the Route above just in one line of code
 */
Route::resource('article','ArticlesController');
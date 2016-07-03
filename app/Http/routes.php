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

Route::get('/', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
| For Volunteers as admins of the entire sites, in 'manage' folder
*/

Route::get('/manage/login', 'AuthController@login_panel');
Route::post('/manage/auth', 'AuthController@login');
Route::get('/manage/logout', 'AuthController@logout');
Route::group(['prefix' => 'manage','middleware' => 'auth','namespace'=>'manage'], function () {

	Route::group(['prefix'=>'devSettings'], function() {
		Route::get('/' , 'DevSettingsController@index') ;
	}) ;

	Route::get('/auth', 'ManageController@auth'); //@TODO: Remove this line at production
	Route::get('/{module}', 'ManageController@show');
	Route::get('/{module}/{sub}', 'ManageController@show');
});



Route::resource('test', 'TestController');


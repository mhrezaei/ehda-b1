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

Route::get('/manage/reset_password', 'AuthController@reset_password');
Route::post('/manage/reset_password_process', 'AuthController@reset_password_process');
Route::post('/manage/reset_password_token_process', 'AuthController@reset_password_token_process');
Route::get('/manage/old_password', 'AuthController@old_password');
Route::post('/manage/auth_password', 'AuthController@old_password_process');
Route::get('/sms', 'AuthController@sms');

Route::group(['prefix' => 'manage','middleware' => 'auth','namespace'=>'manage'], function () {
	Route::get('/' , 'ManageController@index');
	Route::get('/index' , 'ManageController@index');

	Route::group(['prefix'=>'devSettings'], function() {
		Route::get('/' , 'DevSettingsController@index') ;
		Route::get('/{request_tab}/' , 'DevSettingsController@index') ;
		Route::get('/{request_tab}/new' , 'DevSettingsController@add') ; //@TODO: mix it like the others

		Route::get('/{request_tab}/{id}' , 'DevSettingsController@item') ;
		Route::get('/{request_tab}/{id}/edit/{parent_id}' , 'DevSettingsController@editor') ;
		Route::get('/{request_tab}/{id}/edit' , 'DevSettingsController@editor') ;

		Route::get('/{request_tab}/search/{key}' , 'DevSettingsController@search');

		Route::post('/posts-cats/save' , 'DevSettingsController@save_postsCats');
		Route::post('/domains/save' , 'DevSettingsController@save_domains');
		Route::post('/states/save' , 'DevSettingsController@save_states');
		Route::post('/cities/save' , 'DevSettingsController@save_cities');
	}) ;

});



Route::resource('test', 'TestController');


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
	Route::get('/' , 'ManageController@index');
	Route::get('/index' , 'ManageController@index');

	Route::group(['prefix'=>'devSettings'], function() {
		Route::get('/' , 'DevSettingsController@index') ;
		Route::get('/domains/cities/{$q}' , 'DevSettingsController@item_domains') ;
		Route::get('/{request_tab}/' , 'DevSettingsController@index') ;
		Route::get('/{request_tab}/new' , 'DevSettingsController@add') ;
		Route::get('/{request_tab}/{id}' , 'DevSettingsController@item') ;

		Route::post('/posts-cats/save' , 'DevSettingsController@save_postsCats');
		Route::post('/domains/save' , 'DevSettingsController@save_domains');
	}) ;

});



Route::resource('test', 'TestController');


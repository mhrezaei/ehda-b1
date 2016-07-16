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

	/*
	| Volunteers
	*/

	Route::group(['prefix'=>'volunteers'] , function() {
		Route::get('/' , 'VolunteersController@browse') ;
		Route::get('/browse' , 'VolunteersController@browse') ;
		Route::get('/browse/{request_tab}' , 'VolunteersController@browse') ;

		Route::get('/create' , 'VolunteersController@editor') ;
		Route::get('/{volunteer_id}' , 'VolunteersController@show');
		Route::get('/{volunteer_id}/edit' , 'VolunteersController@editor');
		Route::post('/save' , 'VolunteersController@save');

		Route::get('/{volunteer_id}/{modal_action}' , 'VolunteersController@modalActions');
		Route::post('/save/change_password' , 'VolunteersController@change_password');

		Route::get('/search' , 'VolunteersController@search');
		Route::post('/search' , 'VolunteersController@search_result');

		Route::get('/reports' , 'VolunteersController@reports');
		//minor things: role, password_rest, delete, bin_actions
	});

	/*
	| Developer Settings
	*/


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


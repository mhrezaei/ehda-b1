<?php

Route::get('test','TestController@index') ;

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
Route::get('/register', 'CardController@register');
Route::post('/register/first_step', 'CardController@register_first_step');
Route::post('/register/second_step', 'CardController@register_second_step');
Route::post('/register/register_third_step', 'CardController@register_third_step');
Route::get('/organ_donation_card', 'CardController@index');
Route::get('/card/show_card/mini/{national_hash}', 'CardController@card_mini');
Route::get('/card/show_card/full/{national_hash}/{mode?}', 'CardController@card_full');

Route::get('/showPost/{id}/{url?}', 'PostController@show');
Route::get('/previewPost/{id}/{url?}', 'PostController@show');
Route::get('/archive/{branch?}/{category?}', 'PostController@archive');

/*
|--------------------------------------------------------------------------
| CARD HOLDER PANEL
|--------------------------------------------------------------------------
| For the holders of cards, in 'members' folder
*/



Route::group(['prefix' => 'members', 'middleware' => 'MembersAuth', 'namespace' => 'members'], function(){
	Route::get('/my_card', 'MembersController@index');
	Route::get('/my_card/print', 'MembersController@print_my_card');
	Route::get('/my_card/edit', 'MembersController@edit_my_card');
	Route::post('/my_card/edit_process', 'MembersController@edit_card_process');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
| For Volunteers as admins of the entire sites, in 'manage' folder
*/

Route::get('/login', 'AuthController@login_panel');
Route::post('/auth', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');

Route::get('/reset_password', 'AuthController@reset_password');
Route::post('/password/reset_password_process', 'AuthController@reset_password_process');
Route::post('/password/reset_password_token_process', 'AuthController@reset_password_token_process');
Route::get('/password/old_password', 'AuthController@old_password');
Route::post('/password/auth_password', 'AuthController@old_password_process');
Route::get('/sms', 'AuthController@sms');


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
		Route::get('/create/{branch}' , 'VolunteersController@create') ;
		Route::get('/search' , 'VolunteersController@search');
		Route::get('/reports' , 'VolunteersController@reports');

		Route::get('/{volunteer_id}' , 'VolunteersController@show');
		Route::get('/{volunteer_id}/edit' , 'VolunteersController@editor');
		Route::get('/{volunteer_id}/{modal_action}' , 'VolunteersController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'VolunteersController@save');

			Route::post('/change_password' , 'VolunteersController@change_password');
			Route::post('/soft_delete' , 'VolunteersController@soft_delete');
			Route::post('/bulk_soft_delete' , 'VolunteersController@bulk_soft_delete');
			Route::post('/bulk_soft_delete' , 'VolunteersController@bulk_soft_delete');
			Route::post('/undelete' , 'VolunteersController@undelete');
			Route::post('/bulk_undelete' , 'VolunteersController@bulk_undelete');
			Route::post('/hard_delete' , 'VolunteersController@hard_delete');
			Route::post('/bulk_hard_delete' , 'VolunteersController@bulk_hard_delete');
			Route::post('/publish' , 'VolunteersController@publish');
			Route::post('/bulk_publish' , 'VolunteersController@bulk_publish');
			Route::post('/permits' , 'VolunteersController@permits');
			Route::post('/sms' , 'VolunteersController@sms');
			Route::post('/bulk_sms' , 'VolunteersController@bulk_sms');
			Route::post('/email' , 'VolunteersController@email');
			Route::post('/bulk_email' , 'VolunteersController@bulk_email');
			Route::post('/care_review' , 'VolunteersController@care_review');
		});
	});

	/*
| cards
*/

	Route::group(['prefix'=>'cards'] , function() {
		Route::get('/' , 'CardsController@browse') ;
		Route::get('/browse' , 'CardsController@browse') ;
		Route::get('/browse/{request_tab}' , 'CardsController@browse') ;
		Route::get('/search' , 'CardsController@search');
		Route::get('/reports' , 'CardsController@reports');//@TODO: INTACT!

		Route::get('/create' , 'CardsController@create');
		Route::get('/{card_id}' , 'CardsController@show');
		Route::get('/{card_id}/edit' , 'CardsController@editor');
		Route::get('/{card_id}/{modal_action}' , 'CardsController@modalActions');

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'CardsController@save');
			Route::post('/inquiry' , 'CardsController@inquiry');

			Route::post('/add_to_print' , 'CardsController@add_to_print');
			Route::post('/change_password' , 'CardsController@change_password');
			Route::post('/delete' , 'CardsController@delete');
			Route::post('/bulk_delete' , 'CardsController@bulk_delete');
			Route::post('/sms' , 'CardsController@sms');
			Route::post('/bulk_sms' , 'CardsController@bulk_sms');
			Route::post('/email' , 'CardsController@email');
			Route::post('/bulk_email' , 'CardsController@bulk_email');
		});
	});


	/*
	| Posts
	*/
	Route::group(['prefix'=>'posts'] , function() {
		Route::get('/{branch_slug}' , 'PostsController@browse') ;
		Route::get('{branch_slug}/searched' , 'PostsController@searchResult');
		Route::get('{branch_slug}/search' , 'PostsController@searchPanel');
		Route::get('/{branch_slug}/{request_tab}' , 'PostsController@browse') ;

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/' , 'PostsController@save');
			Route::post('/hard_delete' , 'PostsController@hard_delete');
		});
	});

	Route::group(['prefix'=>'account'] , function() {
		Route::get('/' , 'AccountController@index') ;
		Route::get('/{request_tab}' , 'AccountController@index') ;

		Route::group(['prefix'=>'save'] , function() {
			Route::post('/password' , 'AccountController@savePassword');
			Route::post('/profile' , 'AccountController@saveProfile');
			Route::post('/card' , 'AccountController@card');
			Route::post('/card_delete' , 'AccountController@card_delete');
			Route::post('/volunteer_delete' , 'AccountController@volunteer_delete');
		});
	});

	/*
	| SuperAdmin Settings
	*/
	Route::group(['prefix'=>'settings'  , 'middleware' => 'Can:settings'], function() {
		Route::get('/' , 'SettingsController@index') ;
		Route::get('/{request_tab}/' , 'SettingsController@index') ;//@TODO: INTACT

		Route::get('/{request_tab}/{id}' , 'SettingsController@item') ;//@TODO: INTACT
		Route::get('/{request_tab}/{id}/edit/{parent_id}' , 'SettingsController@editor') ;//@TODO: INTACT
		Route::get('/{request_tab}/{id}/edit' , 'SettingsController@editor') ;//@TODO: INTACT
	});


	/*
	| Developer Settings
	*/


	Route::group(['prefix'=>'devSettings' , 'middleware' => 'Dev'], function() {
		Route::get('/' , 'DevSettingsController@index') ;
		Route::get('/{request_tab}/' , 'DevSettingsController@index') ;

		Route::get('/{request_tab}/{id}' , 'DevSettingsController@item') ;
		Route::get('/{request_tab}/{id}/edit/{parent_id}' , 'DevSettingsController@editor') ;
		Route::get('/{request_tab}/{id}/edit' , 'DevSettingsController@editor') ;

		Route::get('/{request_tab}/search/{key}' , 'DevSettingsController@search');

		Route::post('/branches/save' , 'DevSettingsController@save_branches');
		Route::post('/domains/save' , 'DevSettingsController@save_domains');
		Route::post('/states/save' , 'DevSettingsController@save_states');
		Route::post('/cities/save' , 'DevSettingsController@save_cities');
		Route::post('/categories/save' , 'DevSettingsController@save_category');
	}) ;

});

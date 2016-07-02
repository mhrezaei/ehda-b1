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

use App\Http\Controllers\AuthController;

Route::get('/' , 'HomeController@index');

/* Manage Section:: Volunteers Panels */
Route::get('/manage/logout', 'AuthController@logout');
Route::get('/manage/login', 'AuthController@login_panel');
Route::get('/manage/reset_password', 'AuthController@reset_password');
Route::post('/manage/reset_password_process', 'AuthController@reset_password_process');
Route::post('/manage/auth', 'AuthController@login');
Route::get('/manage/auth' , 'ManageController@auth'); //@TODO: Remove this line at production
Route::get('/manage/old_password', 'AuthController@old_password');
Route::post('/manage/auth_password', 'AuthController@old_password_process');
Route::get('/manage/{module}', 'ManageController@show');
Route::get('/manage/{module}/{sub}', 'ManageController@show');
Route::get('/sms', 'AuthController@sms');


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

Route::get('/' , 'HomeController@index');

/* Manage Section:: Volunteers Panels */
Route::get('/manage/login', 'ManageController@login');
Route::get('/manage/index', 'ManageController@index');

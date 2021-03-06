<?php

// API
Route::group(['prefix' => 'api'], function (){
    Route::get('/', 'ApiController@index');
    Route::post('ehda/getToken', 'ApiController@get_token');
    Route::post('/ehda/card/search', 'ApiController@ehda_card_search');
    Route::post('/ehda/card/register', 'ApiController@ehda_card_register');
    Route::post('/ehda/card/get', 'ApiController@get_card');
    Route::post('/ehda/province/get', 'ApiController@get_province');
    Route::post('/ehda/cities/get', 'ApiController@get_cities');
    Route::post('/ehda/education/get', 'ApiController@get_education');
});


// subdomain
Route::group(['prefix' => '', 'middleware' => 'Subdomain'], function () {


//    Route::get('test', 'TestController@index');
//    Route::get('convertVolunteers', 'TestController@convertVolunteers');
//    Route::get('removeDuplicates', 'TestController@removeDuplicates');
//    Route::get('makeDomains', 'TestController@makeDomainsFromHomeCities');
//
    Route::get('hadi/ajax', 'TestController@hadi_ajax');
    Route::post('hadi/ajax/response', 'TestController@hadi_ajax_response');
    Route::get('mhadi/{status?}/{act?}', 'TestController@hadi');
    Route::get('hadi/pwsets' , 'TestController@password_set_for_unverified_volunteers') ;

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
    Route::get('/ramazan', 'HomeController@ramazan');
    Route::post('/ramazan', 'HomeController@ramazan_count');

    Route::get('/summer', 'HomeController@summer');
    Route::post('/summer', 'HomeController@summer_count');

    Route::get('/register', 'CardController@register');
    Route::post('/register/first_step', 'CardController@register_first_step');
    Route::post('/register/second_step', 'CardController@register_second_step');
    Route::post('/register/register_third_step', 'CardController@register_third_step');

    Route::get('/card/show_card/mini/{national_hash}', 'CardController@card_mini');
    Route::get('/card/show_card/single/{national_hash}/{mode?}', 'CardController@card_single');
    Route::get('/card/show_card/social/{national_hash}', 'CardController@card_social');
    Route::get('/card/show_card/full/{national_hash}/{mode?}', 'CardController@card_full');

    Route::get('/{id}', 'PostController@show')->where('id', '[0-9]+');
    Route::get('/showPost/{id}/{url?}', 'PostController@show');
    Route::get('/previewPost/{id}/{url?}', 'PostController@show');
    Route::get('/archive/{branch?}/{category?}', 'PostController@archive');
    Route::get('/gallery/categories/{branch}', 'GalleryController@show_categories');
    Route::get('/gallery/posts/{category}', 'GalleryController@show_categories_posts');
    Route::get('/gallery/show/{id}/{url?}', 'GalleryController@show_gallery');

    Route::get('/convert', 'TestController@convertCardsFromMhr');

// static pages
    Route::get('/organ_donation_card', 'CardController@index');
    Route::get('/faq', 'PostController@faq');
    Route::post('/faq/new', 'PostController@faq_new');
    Route::get('/angels', 'PostController@angels');
    Route::post('/angels/find', 'PostController@angels_find');

// volunteer pages
    Route::get('/volunteers', 'members\VolunteersController@index');
    Route::post('/volunteer/first_step', 'members\VolunteersController@register_first_step');
    Route::post('/volunteer/second_step', 'members\VolunteersController@register_second_step');
    Route::get('/volunteers/exam', 'members\VolunteersController@exam');
    Route::get('/volunteers/final_step', 'members\VolunteersController@register_final_step');
    Route::post('/volunteers/final_step/submit', 'members\VolunteersController@register_final_step_submit');

    /*
    |--------------------------------------------------------------------------
    | CARD HOLDER PANEL
    |--------------------------------------------------------------------------
    | For the holders of cards, in 'members' folder
    */


    Route::group(['prefix' => 'members', 'middleware' => 'MembersAuth', 'namespace' => 'members'], function () {
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
    Route::get('/relogin', 'AuthController@relogin_panel');
    Route::post('/auth', 'AuthController@login');
    Route::get('/logout', 'AuthController@logout');

    Route::get('/reset_password', 'AuthController@reset_password');
    Route::post('/password/reset_password_process', 'AuthController@reset_password_process');
    Route::post('/password/reset_password_token_process', 'AuthController@reset_password_token_process');
    Route::get('/password/old_password', 'AuthController@old_password');
    Route::post('/password/auth_password', 'AuthController@old_password_process');
    Route::get('/sms', 'AuthController@sms');


    Route::group(['prefix' => 'manage', 'middleware' => 'auth', 'namespace' => 'manage'], function () {
        Route::get('/', 'ManageController@index');
        Route::get('/index', 'ManageController@index');



        /*
        | Services
        */
        Route::group(['prefix' => "services"] , function() {
            Route::get('sms' , 'ManageController@smsForm');
            Route::post('sms' , 'ManageController@smsSend');
        } );

        /*
        | Volunteers
        */

        Route::group(['prefix' => 'volunteers'], function () {
            Route::get('/', 'VolunteersController@browse');
            Route::get('/browse', 'VolunteersController@browse');
            Route::get('/browse/{request_tab}', 'VolunteersController@browse');
            Route::get('/create/', 'VolunteersController@editor');
            Route::get('/search', 'VolunteersController@search');
            Route::get('/reports', 'VolunteersController@reports');

            Route::get('/{volunteer_id}', 'VolunteersController@show');
            Route::get('/{volunteer_id}/edit', 'VolunteersController@editor');
            Route::get('/{volunteer_id}/{modal_action}', 'VolunteersController@modalActions');

            Route::group(['prefix' => 'save'], function () {
                Route::post('/', 'VolunteersController@save');
                Route::post('/inquiry', 'VolunteersController@inquiry');

                Route::post('/change_password', 'VolunteersController@change_password');
                Route::post('/soft_delete', 'VolunteersController@soft_delete');
                Route::post('/bulk_soft_delete', 'VolunteersController@bulk_soft_delete');
                Route::post('/bulk_soft_delete', 'VolunteersController@bulk_soft_delete');
                Route::post('/undelete', 'VolunteersController@undelete');
                Route::post('/bulk_undelete', 'VolunteersController@bulk_undelete');
                Route::post('/hard_delete', 'VolunteersController@hard_delete');
                Route::post('/bulk_hard_delete', 'VolunteersController@bulk_hard_delete');
                Route::post('/publish', 'VolunteersController@publish');
                Route::post('/bulk_publish', 'VolunteersController@bulk_publish');
                Route::post('/permits', 'VolunteersController@permits');
                Route::post('/sms', 'VolunteersController@sms');
                Route::post('/bulk_sms', 'VolunteersController@bulk_sms');
                Route::post('/email', 'VolunteersController@email');
                Route::post('/bulk_email', 'VolunteersController@bulk_email');
                Route::post('/care_review', 'VolunteersController@care_review');
            });
        });

        /*
        | cards
        */

        Route::group(['prefix' => 'cards'], function () {
            Route::get('/', 'CardsController@browse');
            Route::get('/browse', 'CardsController@browse');
            Route::get('/stats', 'CardsController@stats');
            Route::get('/browse/{request_tab}/{volunteer?}/{post?}', 'CardsController@browse');
            Route::get('/search', 'CardsController@search');
            Route::get('/reports', 'CardsController@reports');//@TODO: INTACT!

            Route::get('/printings/modal/{printing_id}/{modal_action}', 'PrintingsController@modalActions');
            Route::get('/printings/download_excel/{event_id}', 'PrintingsController@excelDownload');
            Route::get('/printings/{request_tab?}/{event_id?}/{user_id?}/{volunteer_id?}' , 'PrintingsController@browse');

            Route::get('/create/{volunteer_id?}', 'CardsController@create');
            Route::get('/{card_id}', 'CardsController@show');
            Route::get('/{card_id}/edit', 'CardsController@editor');
            Route::get('/{card_id}/{modal_action}', 'CardsController@modalActions');

            Route::group(['prefix' => 'save'], function () {
                Route::post('/', 'CardsController@save');
                Route::post('/volunteers', 'CardsController@saveForVolunteers');
                Route::post('/inquiry', 'CardsController@inquiry');

                Route::post('/add_to_print', 'CardsController@add_to_print');
                Route::post('/change_password', 'CardsController@change_password');
                Route::post('/delete', 'CardsController@delete');
                Route::post('/bulk_delete', 'CardsController@bulk_delete');
                Route::post('/sms', 'CardsController@sms');
                Route::post('/bulk_sms', 'CardsController@bulk_sms');
                Route::post('/email', 'CardsController@email');
                Route::post('/bulk_email', 'CardsController@bulk_email');
                Route::post('/print', 'CardsController@single_print');
                Route::post('/bulk_print', 'CardsController@bulk_print');
                
                Route::post('printings/bulk_excel' , 'PrintingsController@bulkExcel');
                Route::post('printings/bulk_print' , 'PrintingsController@bulkPrint');
                Route::post('printings/bulk_confirm' , 'PrintingsController@bulkConfirm');
            });
        });


        /*
        | Posts
        */
        Route::group(['prefix' => 'posts'], function () {
            Route::get('/{branch_slug}', 'PostsController@browse');
            Route::get('{branch_slug}/edit/{post_id}', 'PostsController@editor');
            Route::get('{branch_slug}/searched', 'PostsController@searchResult');
            Route::get('{branch_slug}/search', 'PostsController@searchPanel');
            Route::get('/{branch_slug}/{request_tab}/{request_category?}', 'PostsController@browse');

            Route::group(['prefix' => 'save'], function () {
                Route::post('/', 'PostsController@save');
                Route::post('/hard_delete', 'PostsController@hard_delete');
            });
        });

        Route::group(['prefix' => 'account'], function () {
            Route::get('/', 'AccountController@index');
            Route::get('/{request_tab}', 'AccountController@index');

            Route::group(['prefix' => 'save'], function () {
                Route::post('/password', 'AccountController@savePassword');
                Route::post('/profile', 'AccountController@saveProfile');
                Route::post('/card', 'AccountController@card');
                Route::post('/card_delete', 'AccountController@card_delete');
                Route::post('/volunteer_delete', 'AccountController@volunteer_delete');
            });
        });

        /*
        | SuperAdmin Settings
        */
        Route::group(['prefix' => 'settings', 'middleware' => 'Can:settings'], function () {
            Route::get('/', 'SettingsController@index');
            Route::get('/{request_tab}/', 'SettingsController@index');//@TODO: INTACT

            Route::post('/save', 'settingsController@save');

        });


        /*
        | Developer Settings
        */


        Route::group(['prefix' => 'devSettings', 'middleware' => 'Dev'], function () {
            Route::get('/', 'DevSettingsController@index');
            Route::get('/{request_tab}/', 'DevSettingsController@index');

            Route::get('/{request_tab}/{id}', 'DevSettingsController@item');
            Route::get('/{request_tab}/{id}/edit/{parent_id}', 'DevSettingsController@editor');
            Route::get('/{request_tab}/{id}/edit', 'DevSettingsController@editor');

            Route::get('/{request_tab}/search/{key}', 'DevSettingsController@search');

            Route::post('/branches/save', 'DevSettingsController@save_branches');
            Route::post('/domains/save', 'DevSettingsController@save_domains');
            Route::post('/states/save', 'DevSettingsController@save_states');
            Route::post('/cities/save', 'DevSettingsController@save_cities');
            Route::post('/categories/save', 'DevSettingsController@save_category');
            Route::post('/downstream/save', 'DevSettingsController@save_downstream');
            Route::post('/activities/save', 'DevSettingsController@save_activities');
            Route::post('/downstream/set', 'DevSettingsController@set_downstream');

            Route::post('/login_as/', 'DevSettingsController@loginAs');
        });

    });

});

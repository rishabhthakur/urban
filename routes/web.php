<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/get_unread', function() {
    return Auth::user()->unreadNotifications;
});

Route::get('/get_notifications', function() {
    return Auth::user()->notifications;
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

// Route::get('/check_verified', [
//     'uses' => 'HomeController@check',
//     'as' => 'check.verify'
// ]);

/* Admin routes */
Route::group(['middleware' => 'auth'], function() {

    // Customer accounts
    Route::get('/home', 'HomeController@index')->name('home');
});

// Admin auth routes
Route::get('/admin/login', [
    'uses' => 'AdminController@login',
    'as' => 'admin.login'
]);

/* Admin routes */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {

    // Admin dashboard page
    Route::get('/', [
        'uses' => 'AdminController@index',
        'as' => 'admin'
    ]);

    // Admin dashboard page
    Route::group(['prefix' => 'media'], function() {

        // Admin media library page
        Route::get('/', [
            'uses' => 'MediaController@index',
            'as' => 'admin.media'
        ]);

        // Admin media library page
        Route::get('/create', [
            'uses' => 'MediaController@create',
            'as' => 'admin.media.create'
        ]);

        // Admin media library page
        Route::post('/store', [
            'uses' => 'MediaController@store',
            'as' => 'admin.media.store'
        ]);

        // Admin settings routes
        Route::group(['prefix' => 'media'], function() {

            // Admin settings
            Route::get('/', [
                'uses' => 'SettingsController@index',
                'as' => 'admin.settings'
            ]);

            // Admin shop settings
            Route::get('/shop', [
                'uses' => 'SettingsController@shop',
                'as' => 'admin.settings.shop'
            ]);

            // Admin discussion settings
            Route::get('/discussions', [
                'uses' => 'SettingsController@discussions',
                'as' => 'admin.settings.discussions'
            ]);

            // Admin media settings
            Route::get('/media', [
                'uses' => 'SettingsController@media',
                'as' => 'admin.settings.media'
            ]);

            // Admin media settings
            Route::get('/privacy', [
                'uses' => 'SettingsController@privacy',
                'as' => 'admin.settings.privacy'
            ]);

            // Admin media settings
            Route::post('/store', [
                'uses' => 'SettingsController@store',
                'as' => 'admin.settings.store'
            ]);

            // Admin media settings
            Route::post('/store/status', [
                'uses' => 'SettingsController@store_status',
                'as' => 'admin.settings.store.status'
            ]);
        });
    });
});

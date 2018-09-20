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

// Maintenance view
Route::get('/maintenance', [
    'uses' => 'MaintenanceViewController@index',
    'as' => 'maintenance'
]);

// All public routes
Route::group(['middleware' => 'maintenance'], function() {

    // Landing page
    Route::get('/', [
        'uses' => 'PublicViewsController@index',
        'as' => 'home'
    ]);

    // About page
    Route::get('/about', [
        'uses' => 'PublicViewsController@about',
        'as' => 'about'
    ]);

    // Blog page
    Route::get('/blog', [
        'uses' => 'PublicViewsController@blog',
        'as' => 'blog'
    ]);

    // Contact page
    Route::get('/contact', [
        'uses' => 'PublicViewsController@contact',
        'as' => 'contact'
    ]);

    // Cart page
    Route::get('/cart', [
        'uses' => 'PublicViewsController@cart',
        'as' => 'cart'
    ]);

    // Cart page
    Route::get('/checkout', [
        'uses' => 'PublicViewsController@checkout',
        'as' => 'checkout'
    ])->middleware('auth');

    // All auth routes
    Auth::routes();

    // Route::get('/check_verified', [
    //     'uses' => 'HomeController@check',
    //     'as' => 'check.verify'
    // ]);

    // Member auth routes
    Route::group(['prefix' => 'account', 'middleware' => 'auth'], function() {

        // Customer accounts
        Route::get('/', [
            'uses' => 'HomeController@index',
            'as' => 'account'
        ]);
    });
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

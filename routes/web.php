<?php

// All auth routes
Auth::routes(['verify' => true]);

// Admin auth routes
Route::get('/admin/login', [
    'uses' => 'AdminController@login',
    'as' => 'admin.login'
]);

/**
 * All public routes
 * @var null
 */

// Landing page
Route::get('/', [
    'uses' => 'PublicViewsController@index',
    'as' => 'home'
]);

// Shop page
Route::get('/shop', [
    'uses' => 'PublicViewsController@shop',
    'as' => 'shop'
]);

// Single product page
Route::get('/product/{slug}', [
    'uses' => 'PublicViewsController@product',
    'as' => 'product'
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

// Message store controller
Route::post('/contact/store', [
    'uses' => 'MessageController@store',
    'as' => 'contact.store'
]);

// Shopping cart route group
Route::group(['prefix' => 'cart'], function() {

    // Shopping cart page
    Route::get('/', [
        'uses' => 'PublicViewsController@cart',
        'as' => 'cart'
    ]);

    // Shopping cart page
    Route::post('/add/{id}', [
        'uses' => 'cartController@store',
        'as' => 'cart.add'
    ]);
});

// Checkout page
Route::get('/checkout', [
    'uses' => 'PublicViewsController@checkout',
    'as' => 'checkout'
])->middleware('auth');

// Newsletter subscription
Route::post('/subscribe', [
    'uses' => 'NewsletterController@store',
    'as' => 'subscribe'
]);

// Member auth routes
Route::group(['prefix' => 'account', 'middleware' => 'verified'], function() {

    // Customer accounts
    Route::get('/', [
        'uses' => 'ProfileController@index',
        'as' => 'account'
    ]);
});

/* Admin routes */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {

    // Admin dashboard page
    Route::get('/', [
        'uses' => 'AdminController@index',
        'as' => 'admin'
    ]);

    // Admin log
    Route::get('/log', [
        'uses' => 'AdminController@log',
        'as' => 'admin.log'
    ]);

    // Admin users routes
    Route::group(['prefix' => 'users'], function() {

        // Admin users list
        Route::get('/', [
            'uses' => 'UsersController@index',
            'as' => 'admin.users'
        ]);

        // Admin add new users
        Route::get('/create', [
            'uses' => 'UsersController@create',
            'as' => 'admin.users.create'
        ]);

        // Admin add new users to database
        Route::post('/store', [
            'uses' => 'UsersController@store',
            'as' => 'admin.users.store'
        ]);

        // Admin user profile
        Route::get('/profile/{slug}', [
            'uses' => 'UsersController@profile',
            'as' => 'admin.users.profile'
        ]);

        // Admin user profile
        Route::post('/update/{slug}', [
            'uses' => 'UsersController@update',
            'as' => 'admin.users.update'
        ]);

        // Admin user activities - reserved only for Administrators
        Route::get('/activities/{slug}', [
            'uses' => 'UsersController@activities',
            'as' => 'admin.users.activities'
        ]);

        // Admin user edit
        Route::get('/edit/{slug}', [
            'uses' => 'UsersController@edit',
            'as' => 'admin.users.edit'
        ]);
    });

    // Admin products routes
    Route::group(['prefix' => 'products'], function() {

        // Admin products list
        Route::get('/', [
            'uses' => 'ProductController@index',
            'as' => 'admin.products'
        ]);

        // Admin add new products
        Route::get('/create', [
            'uses' => 'ProductController@create',
            'as' => 'admin.products.create'
        ]);

        // Admin add new products
        Route::post('/store', [
            'uses' => 'ProductController@store',
            'as' => 'admin.products.store'
        ]);

        // Admin edit products
        Route::get('/edit', [
            'uses' => 'ProductController@edit',
            'as' => 'admin.products.edit'
        ]);

        // Admin edit products
        Route::post('/update', [
            'uses' => 'ProductController@update',
            'as' => 'admin.products.update'
        ]);

        // Admin products categories
        Route::group(['prefix' => 'categories'], function() {

            // Admin products categories list
            Route::get('/', [
                'uses' => 'ScategoryController@index',
                'as' => 'admin.products.categories'
            ]);

            Route::post('/store', [
                'uses' => 'ScategoryController@store',
                'as' => 'admin.products.categories.store'
            ]);
        });

        // Admin products tags
        Route::group(['prefix' => 'tags'], function() {

            // Admin products tags list
            Route::get('/', [
                'uses' => 'StagController@index',
                'as' => 'admin.products.tags'
            ]);

            Route::post('/store', [
                'uses' => 'StagController@store',
                'as' => 'admin.products.tags.store'
            ]);
        });

        // Admin products brands
        Route::group(['prefix' => 'brands'], function() {

            // Admin products brands list
            Route::get('/', [
                'uses' => 'BrandController@index',
                'as' => 'admin.products.brands'
            ]);

            Route::post('/store', [
                'uses' => 'BrandController@store',
                'as' => 'admin.products.brands.store'
            ]);
        });

        // Admin products attributes
        Route::group(['prefix' => 'attributes'], function() {

            // Admin products attributes list
            Route::get('/', [
                'uses' => 'AttributeController@index',
                'as' => 'admin.products.attributes'
            ]);

            Route::post('/store', [
                'uses' => 'AttributeController@store',
                'as' => 'admin.products.attributes.store'
            ]);

            // Admin products attributes data list
            Route::get('/data/{id}', [
                'uses' => 'AttributeController@data',
                'as' => 'admin.products.attributes.data'
            ]);

            Route::post('/data/store/{id}', [
                'uses' => 'AttributeController@data_store',
                'as' => 'admin.products.attributes.data.store'
            ]);
        });
    });

    // Admin media routes
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

    });

    // Admin messages routes
    Route::group(['prefix' => 'messages'], function() {

        // Admin messages list
        Route::get('/', [
            'uses' => 'MessageController@index',
            'as' => 'admin.messages'
        ]);
    });

    // Admin newsletter routes
    Route::group(['prefix' => 'newsletter'], function() {


    });

    // Admin settings routes
    Route::group(['prefix' => 'settings'], function() {

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
        Route::get('/discussion', [
            'uses' => 'SettingsController@discussion',
            'as' => 'admin.settings.discussion'
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

        // Admin media settings
        Route::post('/store/privacy_status', [
            'uses' => 'SettingsController@privacy_status',
            'as' => 'admin.settings.privacy.status'
        ]);
    });
});

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

// Blog post page
Route::get('/blog/{slug}', [
    'uses' => 'PublicViewsController@post',
    'as' => 'blog.post'
]);

// Blog post comment store
Route::post('/blog/comment/store/{id}', [
    'uses' => 'CommentController@store',
    'as' => 'blog.comment.store'
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

    // Customer accounts
    Route::get('/details', [
        'uses' => 'ProfileController@details',
        'as' => 'account.details'
    ]);

    Route::post('/update/{id}', [
        'uses' => 'ProfileController@update',
        'as' => 'account.update'
    ]);

    // Customer account addresses
    Route::get('/addresses', [
        'uses' => 'ProfileController@addresses',
        'as' => 'account.addresses'
    ]);

    // Customer accounts
    Route::get('/orders', [
        'uses' => 'ProfileController@orders',
        'as' => 'account.orders'
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

    // Admin categories routes
    Route::group(['prefix' => 'categories'], function() {

        // Admin categories store to database
        Route::post('/store', [
            'uses' => 'CategoryController@store',
            'as' => 'admin.categories.store'
        ]);
    });

    // Admin tags routes
    Route::group(['prefix' => 'tags'], function() {

        // Admin tags store to database
        Route::post('/store', [
            'uses' => 'TagController@store',
            'as' => 'admin.tags.store'
        ]);
    });

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

        // Admin users list
        Route::get('/verify/{id}', [
            'uses' => 'UsersController@verify',
            'as' => 'admin.users.verify'
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
        Route::post('/update/account/{slug}', [
            'uses' => 'UsersController@update_account',
            'as' => 'admin.users.update.account'
        ]);

        // Admin user profile
        Route::post('/update/profile/{slug}', [
            'uses' => 'UsersController@update',
            'as' => 'admin.users.update.profile'
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
        Route::get('/edit/{id}', [
            'uses' => 'ProductController@edit',
            'as' => 'admin.products.edit'
        ]);

        // Admin edit products
        Route::post('/update/{id}', [
            'uses' => 'ProductController@update',
            'as' => 'admin.products.update'
        ]);

        // Admin products categories
        Route::group(['prefix' => 'categories'], function() {

            // Admin products categories list
            Route::get('/{from}', [
                'uses' => 'CategoryController@index',
                'as' => 'admin.products.categories'
            ]);
        });

        // Admin products tags
        Route::group(['prefix' => 'tags'], function() {

            // Admin products tags list
            Route::get('/{from}', [
                'uses' => 'TagController@index',
                'as' => 'admin.products.tags'
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

    // Admin posts routes
    Route::group(['prefix' => 'posts'], function() {

        // Admin posts list
        Route::get('/', [
            'uses' => 'PostController@index',
            'as' => 'admin.posts'
        ]);

        // Admin add new posts
        Route::get('/create', [
            'uses' => 'PostController@create',
            'as' => 'admin.posts.create'
        ]);

        // Admin add new posts
        Route::post('/store', [
            'uses' => 'PostController@store',
            'as' => 'admin.posts.store'
        ]);

        // Admin edit posts
        Route::get('/edit/{id}', [
            'uses' => 'PostController@edit',
            'as' => 'admin.posts.edit'
        ]);

        // Admin edit posts
        Route::post('/update', [
            'uses' => 'PostController@update',
            'as' => 'admin.posts.update'
        ]);

        // Admin posts categories
        Route::group(['prefix' => 'categories'], function() {

            // Admin posts categories list
            Route::get('/{from}', [
                'uses' => 'CategoryController@index',
                'as' => 'admin.posts.categories'
            ]);
        });

        // Admin posts tags
        Route::group(['prefix' => 'tags'], function() {

            // Admin posts tags list
            Route::get('/{from}', [
                'uses' => 'TagController@index',
                'as' => 'admin.posts.tags'
            ]);
        });

        // Admin posts comments
        Route::group(['prefix' => 'comments'], function() {

            // Admin post comments list
            Route::get('/', [
                'uses' => 'CommentController@index',
                'as' => 'admin.posts.comments'
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

        // Admin add new media
        Route::post('/store', [
            'uses' => 'MediaController@store',
            'as' => 'admin.media.store'
        ]);

    });

    // Admin directories routes
    Route::group(['prefix' => 'directories'], function() {

        // Admin add new directory
        Route::post('/store', [
            'uses' => 'FileSystemController@store',
            'as' => 'admin.directories.store'
        ]);
    });

    // Admin messages routes
    Route::group(['prefix' => 'messages'], function() {

        // Admin messages list
        Route::get('/', [
            'uses' => 'MessageController@index',
            'as' => 'admin.messages'
        ]);

        // Admin messages send
        Route::post('/send', [
            'uses' => 'MessageController@send',
            'as' => 'admin.messages.send'
        ]);
    });

    // Admin newsletter routes
    Route::group(['prefix' => 'newsletter'], function() {

        // Admin newsletter subscriber list
        Route::get('/', [
            'uses' => 'NewsletterController@index',
            'as' => 'admin.newsletter'
        ]);
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

        // Admin discussion settings
        Route::post('/discussion/store', [
            'uses' => 'DsettingsController@update',
            'as' => 'admin.settings.discussion.store'
        ]);

        // Admin media settings
        Route::get('/media', [
            'uses' => 'SettingsController@media',
            'as' => 'admin.settings.media'
        ]);

        // Admin media settings
        Route::post('/media/store', [
            'uses' => 'SettingsController@media_store',
            'as' => 'admin.settings.media.store'
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

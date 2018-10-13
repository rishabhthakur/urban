<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Urban\Category;
use Urban\Attribute;
use Urban\Brand;
use Urban\Tag;
use Urban\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Mark user notification as read
 */
Route::middleware('api')->get('/mark', function() {
    User::where('admin', 1)->first()->unreadNotifications->markAsRead();
    return response()->json([
        'message' => 'Notification marked as read.'
    ], 200);
});

/**
 * Products Brands API
 * Used for create new brand vue omponent in add new product page
 */
Route::middleware('api')->post('/brand/store', [
    'uses' => 'BrandController@vue_store',
    'as' => 'brand.vue.store'
]);

Route::middleware('api')->get('/brand', function() {
    return Brand::orderBy('created_at', 'ASC')->get();
});

/**
 * Posts Categories API
 * Used for create new category vue omponent in add new post page
 */

Route::middleware('api')->get('/category/post', function() {
    return Category::where('belongs_to', 'post')->where('parent_id', 0)->orderBy('created_at', 'ASC')->get();
});

/**
 * Products Categories API
 * Used for create new category vue omponent in add new product page
 */
Route::middleware('api')->get('/category/product', function() {
    return Category::where('belongs_to', 'product')->where('parent_id', 0)->orderBy('created_at', 'ASC')->get();
});

Route::middleware('api')->post('/category/store', [
    'uses' => 'CategoryController@vue_store',
    'as' => 'category.vue.store'
]);

/**
 * Products Tags API
 * Used for create new tag vue omponent in add new product page
 */

Route::middleware('api')->get('/tag/product', function() {
    return Tag::where('belongs_to', 'product')->orderBy('created_at', 'ASC')->get();
});

Route::middleware('api')->get('/tag/post', function() {
    return Tag::where('belongs_to', 'post')->orderBy('created_at', 'ASC')->get();
});


/**
 * Posts Tags API
 * Used for create new tag vue omponent in add new post page
 */
Route::middleware('api')->post('/tag/store', [
    'uses' => 'TagController@vue_store',
    'as' => 'tag.vue.store'
]);


/**
 * Products Brands API
 * Used for create new brand vue omponent in add new product page
 */
Route::middleware('api')->post('/attribute/store', [
    'uses' => 'AttributeController@vue_store',
    'as' => 'attribute.vue.store'
]);

Route::middleware('api')->get('/attribute', function() {
    return Attribute::orderBy('created_at', 'ASC')->get();
});

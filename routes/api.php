<?php

use Illuminate\Http\Request;

use Urban\Stag;
use Urban\Category;
use Urban\Brand;
use Urban\Ptag;

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
 * Products Categories API
 * Used for create new category vue omponent in add new product page
 */
Route::middleware('api')->post('/category/store', [
    'uses' => 'CategoryController@vue_store',
    'as' => 'category.vue.store'
]);

Route::middleware('api')->get('/category/product', function() {
    return Category::where('belongs_to', 'product')->where('parent_id', 0)->orderBy('created_at', 'ASC')->get();
});

/**
 * Products Tags API
 * Used for create new tag vue omponent in add new product page
 */
Route::middleware('api')->post('/stag/store', [
    'uses' => 'StagController@vue_store',
    'as' => 'stag.vue.store'
]);

Route::middleware('api')->get('/stag', function() {
    return Stag::orderBy('created_at', 'ASC')->get();
});


/**
 * Posts Categories API
 * Used for create new category vue omponent in add new post page
 */
Route::middleware('api')->post('/category/store', [
    'uses' => 'CategoryController@vue_store',
    'as' => 'category.vue.store'
]);

Route::middleware('api')->get('/category/post', function() {
    return Category::where('belongs_to', 'post')->where('parent_id', 0)->orderBy('created_at', 'ASC')->get();
});

/**
 * Posts Tags API
 * Used for create new tag vue omponent in add new post page
 */
Route::middleware('api')->post('/ptag/store', [
    'uses' => 'PtagController@vue_store',
    'as' => 'ptag.vue.store'
]);

Route::middleware('api')->get('/ptag', function() {
    return Ptag::orderBy('created_at', 'ASC')->get();
});

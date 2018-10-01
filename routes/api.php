<?php

use Illuminate\Http\Request;

use App\Stag;
use App\Brand;
use App\Scategory;

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

Route::get('/mark-as-read', function() {
    Auth::user()->unreadNotifications->markAsRead();
    return response()->json(200);
})->middleware('api');


Route::middleware('api')->post('/brand/store', [
    'uses' => 'BrandController@vue_store',
    'as' => 'brand.vue.store'
]);

Route::middleware('api')->get('/brand', function() {
    return Brand::orderBy('created_at', 'ASC')->get();
});


Route::middleware('api')->post('/category/store', [
    'uses' => 'ScategoryController@vue_store',
    'as' => 'category.vue.store'
]);

Route::middleware('api')->get('/category', function() {
    return Scategory::where('parent_id', 0)->orderBy('created_at', 'ASC')->get();
});


Route::middleware('api')->post('/tag/store', [
    'uses' => 'StagController@vue_store',
    'as' => 'tag.vue.store'
]);

Route::middleware('api')->get('/tag', function() {
    return Stag::orderBy('created_at', 'ASC')->get();
});

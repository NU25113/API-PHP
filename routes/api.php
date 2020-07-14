<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// http://localhost/tot_laravel7/public/api/
Route::get('/', 'API\IndexController@index');
Route::get('/contact/{email}', 'API\IndexController@contact');

// http://localhost/tot_laravel7/public/api/product/3/comment/34
// Route::get('/product/{id}/comment/{comment_id}', function($id, $comment_id) {
//     return 'product id '.$id. ' comment '.$comment_id; //3 34
// });

//optional parameters ?
Route::get('/staff/{name?}', function($name = 'Bob') {
    return 'staff ' . $name;
});

// api/admin
Route::prefix('admin')->group(function() {
    Route::get('/', function() {
        return 'admin index';
    });
    Route::get('/profile', function() {
        return 'admin profile';
    });
    Route::get('/book', function() {
        return 'admin book';
    });
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// day2
Route::apiResource('product', 'API\ProductController');

// Route::get('/product', 'API\ProductControllerr@index');
// Route::post('/product', 'API\ProductControllerr@store');
// Route::get('/product/{id}', 'API\ProductControllerr@show');
// Route::put('/product/{id}', 'API\ProductControllerr@update');
// Route::delete('/product/{id}', 'API\ProductControllerr@destroy');

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
// api/search/product?name=coke&status=active
Route::get('/search/product', 'API\ProductController@search');

// Route::get('/product', 'API\ProductController@index');
// Route::post('/product', 'API\ProductController@store');
// Route::get('/product/{id}', 'API\ProductController@show');
// Route::put('/product/{id}', 'API\ProductController@update');
// Route::delete('/product/{id}', 'API\ProductController@destroy');


//day 3
Route::apiResource('department', 'API\DepartmentController');
// api/search/department?name=บ
Route::get('/search/department', 'API\DepartmentController@search')->middleware(['auth.basic.once']);

Route::apiResource('officer', 'API\OfficerController')->middleware('auth:sanctum');

//Authentication
// api/register
Route::post('/register', 'API\AuthController@register');
// api/login
Route::post('/login', 'API\AuthController@login');
// api/logout
Route::post('/logout', 'API\AuthController@logout');
// api/me
Route::get('/me', 'API\AuthController@me'); //get profile user

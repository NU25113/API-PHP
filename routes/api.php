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


//! get


//TODO http://127.0.0.1/TOT%20KKN/tot_laravel7_for_SmartCity/public/api/product/1
Route::get('/product/{id}/comment/{comment_id}', function($id, $comment_id) {
    return 'product id '.$id. ' comment '.$comment_id; //3 34
});

//TODO http://127.0.0.1/TOT%20KKN/tot_laravel7_for_SmartCity/public/api/staff
Route::get('/staff/{name?}', function($name = 'NUN') {
    return 'staff ' . $name;
});

//TODO http://127.0.0.1/TOT%20KKN/tot_laravel7_for_SmartCity/public/api/product/5
Route::get('/product/{id}', function ($id=1) {
    return 'id:' .$id;
}); //?ไม่ได้บังคับให้ใส่แค่ตัวเลข


//TODO http://127.0.0.1/TOT-KKN/tot_laravel7_for_SmartCity/public/api/username/31
Route::get('/username/{id?}', function ($id) {
    return 'id:' .$id;
})->where('id' ,'[0-9]+'); //?บังคับให้ใส่แค่ตัวเลข


//TODO http://127.0.0.1/TOT-KKN/tot_laravel7_for_SmartCity/public/api/admin/
Route::prefix('admin')->group(function(){
    Route::get('/', function () {
        return 'Index';
    });
    Route::get('/profile', function () {
        return 'Profile';
    });
    Route::get('/book', function () {
        return 'Book';
    });
}); //? การตั้งให้เป็น GROUP เพื่อให้การเข้าสู่หน้าเร้าเป็นกลุ่ม


Route::middleware('auto:api', 'throttle:60,1')->group(function(){
    Route::get('/user', function () {
        //
    });
}); //? ความปลอดภัย ให้จำกัดเข้าเข้าเร้า แค่ 60 ครั้งต่อ 1 นาที


                      //! นำไปที่ controller แล้ว
//* http://127.0.0.1/TOT%20KKN/tot_laravel7_for_SmartCity/public/api
Route::get('/','API\IndexController@index');
Route::get('/contact/{email}','API\IndexController@contact');
Route::get('/search/product', 'API\ProductController@search');
Route::apiResource('product', 'API\ProductController');

// Route::middleware('auto:api')->get('/user', function (Request $request){
//     return $request->user();
// });

Route::apiResource('department/', 'API\DepartmentController');

Route::apiResource('emergency/', 'API\EmergencyController');

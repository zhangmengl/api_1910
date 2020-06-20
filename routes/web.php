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

Route::get('/', function () {
    return view('welcome');
});
Route::any('test','TestController@test');//测试
Route::any('/test/shop','TestController@shop');//测试数据库
Route::any('/phpinfo',function(){
    phpinfo();
});//测试php的redis扩展

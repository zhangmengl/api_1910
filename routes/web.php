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
Route::any('phpinfo',function(){
    phpinfo();
});//测试php的redis扩展

//前台
Route::prefix('index/')->group(function () {
    Route::get("/user/reg","Index\UserController@reg");//前台注册
    Route::post("/user/regDo","Index\UserController@regDo");//执行注册
    Route::get("/user/login","Index\UserController@login");//前台登录
    Route::post("/user/loginDo","Index\UserController@loginDo");//执行登录
    Route::middleware("isLogin")->get("/user/userCenter","Index\UserController@userCenter");//个人中心
});

//接口api
Route::prefix('api/')->group(function () {
    Route::post("/user/reg","Api\UserController@reg");//注册
    Route::post("/user/login","Api\UserController@login");//登录
    Route::middleware("isPri")->get("/user/userCenter","Api\UserController@userCenter");//个人中心
    Route::middleware("isPri")->get("/user/order","Api\UserController@order");//我的订单
});
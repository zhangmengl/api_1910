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

Route::get('phpinfo',function(){
    phpinfo();
});//测试php的redis扩展
//测试
Route::prefix('test')->group(function () {
    Route::get('/test','TestController@test');//测试
    Route::get('/shop','TestController@shop');//测试数据库
    Route::get('/sign1','TestController@sign1');//验签发送数据
    Route::get('/secret','TestController@secret');//验签接收数据
    Route::get('/www','TestController@www');//接口测试
    Route::get('/sendData','TestController@sendData');//接口传输数据  get
    Route::post('/postData','TestController@postData');//接口传输数据  post
    Route::get('/encrypt','TestController@encrypt');//对称加密
    Route::get('/rsaEncrypt','TestController@rsaEncrypt');//非对称加密
    Route::get('/rsaSign1','TestController@rsaSign1');//非对称加密  --签名
});

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


//防刷
Route::prefix('api/')->middleware("AccessFil","isPri")->group(function () {
    Route::get("/test/a","Api\TestController@a");
    Route::get("/test/b","Api\TestController@b");
    Route::get("/test/c","Api\TestController@c");
    Route::get("/test/d","Api\TestController@d");
});
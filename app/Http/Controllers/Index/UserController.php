<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Model\Users;

class UserController extends Controller
{
    //前台注册
    public function reg(){
        return view("index.reg");
    }
    //执行注册
    public function regDo(){
        //接收传过来的所有值
        $data=request()->except("_token");
        //验证
        request()->validate([
            'user_name' => 'unique:users',
            'email' => 'unique:users',
            'password' => 'regex:/^\d{6,}$/'
        ],[
            'user_name.unique' => '用户名已存在！',
            'email.unique' => '邮箱已存在！',
            'password.regex' => '密码长度在6位以上！'
        ]);
        if($data["pwd"]!=$data["password"]){
            return redirect("/index/user/reg")->with("pwd","确认密码要和密码一致！");die;
        }
        $data["password"]=password_hash($data["password"],PASSWORD_BCRYPT);
        $data["reg_time"]=time();
        $res=Users::insert($data);
//        dd($res);
        if($res){
            return redirect("/index/user/login");
        }
    }
    //前台登录
    public function login(){
        return view("index.login");
    }
    //执行登录
    public function loginDo(){
        //接收传过来的所有值
        $post=request()->except("_token");
        $user=Users::where("user_name",$post["user_name"])->first();
        $password=password_verify( $post["password"],$user["password"]);
//        dd($password);
        if($user==""){
            return redirect("/index/user/login")->with("user_name","用户名或密码有误！");
        }else if($password!=$post["password"]){
            return redirect("/index/user/login")->with("password","用户名或密码有误！");
        }
        session(["user"=>$user]);
        return redirect("/index/user/userCenter");
    }
    //个人中心
    public function userCenter(){
        return view("index.user");
    }
}

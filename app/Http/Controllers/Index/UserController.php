<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
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
        //密码
        $len=strlen($data["password"]);
        if($len<6){
            return redirect("/index/user/reg")->with("password","密码的长度不小于6位！");die;
        }
        //确认密码
        if($data["pwd"]!=$data["password"]){
            return redirect("/index/user/reg")->with("pwd","确认密码要和密码一致！");die;
        }
        //用户名
        $user_name=Users::where("user_name",$data["user_name"])->first();
        if($user_name){
            return redirect("/index/user/reg")->with("user_name","用户名已存在！");die;
        }
        //邮箱
        $email=Users::where("email",$data["email"])->first();
        if($email){
            return redirect("/index/user/reg")->with("email","邮箱已存在！");die;
        }
        //对密码加密
        $data["password"]=password_hash($data["password"],PASSWORD_BCRYPT);
        $data["reg_time"]=time();//时间戳
        $res=Users::insert($data);//把数据存入数据库
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
        //验证密码    解密的密码和输入的密码一样返回true  否则返回false
        $password=password_verify( $post["password"],$user["password"]);
//        dd($password);
        if($user==""){
            return redirect("/index/user/login")->with("user_name","用户名或密码有误！");
        }else if($password!=$post["password"]){
            return redirect("/index/user/login")->with("password","用户名或密码有误！");
        }
        Users::where("user_id",$user["user_id"])->update(["login_time"=>time()]);
        session(["user"=>$user]);
        return redirect("/index/user/userCenter");
    }
    //个人中心
    public function userCenter(){
        $user_id=session("user")->user_id;
        $user=Users::where("user_id",$user_id)->first();
        return view("index.user",compact("user"));
    }
}

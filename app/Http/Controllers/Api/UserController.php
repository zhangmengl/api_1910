<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Users;
use App\Model\Token;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    //注册
    public function reg(){
        //接收传过来的所有值
        $data=request()->except("_token");
        //密码
        $len=strlen($data["password"]);
        if($len<6){
              $response=[
                  "errno"=>"50001",
                  "msg"=>"密码的长度不小于6位！"
              ];
              return $response;
        }
        //确认密码
        if($data["pwd"]!=$data["password"]){
            $response=[
                "errno"=>"50002",
                "msg"=>"确认密码要和密码一致！"
            ];
            return $response;
        }
        //用户名
        $user_name=Users::where("user_name",$data["user_name"])->first();
        if($user_name){
            $response=[
                "errno"=>"50003",
                "msg"=>"用户名已存在!"
            ];
            return $response;
        }
        //邮箱
        $email=Users::where("email",$data["email"])->first();
        if($email){
            $response=[
                "errno"=>"50004",
                "msg"=>"邮箱已存在!"
            ];
            return $response;
        }
        //对密码加密
        $data["password"]=password_hash($data["password"],PASSWORD_BCRYPT);
        $data["reg_time"]=time();//时间戳
        $res=Users::insert($data);//把数据存入数据库
        if($res){
            $response=[
                "errno"=>"0",
                "msg"=>"注册成功！"
            ];
        }else{
            $response=[
                "errno"=>"50005",
                "msg"=>"注册失败！"
            ];
        }
        return $response;
    }
    //登录
    public function login(){
        //接收传过来的所有值
        $post=request()->except("_token");
        $user=Users::where("user_name",$post["user_name"])->first();
        //验证密码    解密的密码和输入的密码一样返回true  否则返回false
        $password=password_verify( $post["password"],$user["password"]);
        //存登录时间
        Users::where("user_id",$user["user_id"])->update(["login_time"=>time()]);
        if($password){
            //生成token
            $str=$user->user_id.$user->user_name.time();
            $token=substr(md5($str),10,16).substr(md5($str),0,16);

//            //将token和用户id存入数据库
//            $data=[
//                "user_id"=>$user["user_id"],
//                "token"=>$token
//            ];
//            Token::insert($data);

            //将token和用户id存入redis
            Redis::set($token,$user->user_id);
            Redis::set("name",$post["name"]);
            $response=[
                "errno"=>"0",
                "msg"=>"登录成功！",
                "token"=>$token
            ];
        }else{
            $response=[
                "errno"=>"50006",
                "msg"=>"用户名或密码有误！"
            ];
        }
        return $response;
    }
    //个人中心
    public function userCenter(){
        $token=request()->token;//接收token
//        $res=Token::where(["token"=>$token])->first();//检查token是否有效
        $user_id=Redis::get($token);
        if($user_id){
            $user=Users::find($user_id);
            echo Redis::get("name")."，欢迎来到个人中心！";
        }else{
            $response=[
                "errno"=>"50006",
                "msg"=>"请先登录！"
            ];
            return $response;
        }

    }
    //我的订单
    public function order(){
        $arr=[
            "1237673575570",
            "5437675675630",
            "9837674375630",
            "6737673545630",
            "4537672375630"
        ];
        $response=[
            "errno"=>"50008",
            "msg"=>"请先登录！",
            "arr"=>$arr
        ];
        return $response;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
class TestController extends Controller
{
    public function test(){
        echo __METHOD__;echo '</br>';
        echo date('Y-m-d H:i:s');
    }
    //商品详情页
    public function shop(){
        $goods_id = $_GET['id'];    //接受url的get参数id
        //echo 'goods_id:'.$goods_id;echo '<br>';die;

        //查询商品详情
        $info = Goods::where(['goods_id'=>$goods_id])->first()->toArray();
//        $info = Goods::find($goods_id);
        var_dump($info);
//        echo '<pre>';print_r($info);echo '</pre>';
    }


    //验签发送数据
    public function sign1(){
        $key='sdlfkjsdlfkjsfsdf';
        $data='hello world';
        $sign=sha1($data.$key);   //生成签名
        echo "发送的数据：".$data;echo "<br>";
        echo "发送前生成的签名：".$sign;echo "<hr>";

        $b_url="http://www.api1910.com/test/secret?data=".$data."&sign=".$sign;
        echo $b_url;
    }
    //验签接收数据
    public function secret(){
        $key='sdlfkjsdlfkjsfsdf';
        echo '<pre>';print_r($_GET);echo '</pre>';
        //接收到数据，验证签名
        $data=$_GET['data'];   //接收到的数据
        $sign=$_GET['sign'];   //接收到的签名
        $local_sign=sha1($data.$key);   //验签算法 与 发送端的生成签名算法保持一致 md5(data+key)
        echo '本地计算的签名：'.$local_sign;echo '<br>';
        if($sign==$local_sign){
            echo "验签通过";
        }else{
            echo "验签失败";
        }
    }
    //接口测试
    public function www(){
        $key = '1910';
        //向接口发送数据
        //get方式发送
        $data = 'hello';
        $sign = sha1($data.$key);

        $url="http://www.api.com/api/test/info?data=".$data."&sign=".$sign;//接口地址
//        echo $url;

        //php 发起网络请求
        $response = file_get_contents($url);
        echo $response;
    }
    //接口传输数据  get
    public function sendData(){
        $url="http://www.api.com/api/test/receive?user_name=张萌丽&user_age=18";
        $response=file_get_contents($url);
        echo $response;
    }
    //接口传输数据  post
    public function postData(){
        $key = 'secret';
        $data = [
            "user_name" => "zhangmengli",
            "user_age" => 2001
        ];

        $str = json_encode($data).$key;
        $sign = sha1($str);

        $send_data = [
            'data'  => json_encode($data),
            'sign'  => $sign
        ];
        $url = "http://www.api.com/api/test/receivePost";

        //使用curl    传输post数据
        //1.实例化
        $ch = curl_init();

        //2.配置参数
        curl_setopt($ch,CURLOPT_URL,$url);   //链接地址
        curl_setopt($ch,CURLOPT_POST,1);   //使用post
        curl_setopt($ch,CURLOPT_POSTFIELDS,$send_data);   //传输的数据
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);   //通过变量接收响应

        //开启会话（发送请求）
        $response = curl_exec($ch);

        //检测错误
        $errno = curl_errno($ch);   //错误码
        $errmsg = curl_error($ch);

        if($errno){
            echo '错误码： '.$errno;echo '</br>';
            var_dump($errmsg);
            die;
        }

        curl_close($ch);

        echo $response;

    }
}

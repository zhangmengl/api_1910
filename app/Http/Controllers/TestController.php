<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Model\Goods;
class TestController extends Controller
{
    public function test(){
        echo __METHOD__;echo '</br>';
        echo date('Y-m-d H:i:s');
    }
    //商品详情页
    public function shop(){
        $goods_id = $_GET['id'];    //接受url的get参数id
        echo 'goods_id:'.$goods_id;echo '<br>';

        //查询商品详情
//        $info = Goods::where(['goods_id'=>$goods_id])->first()->toArray();
//        $info = Goods::find($goods_id);
//        var_dump($info);
//        echo '<pre>';print_r($info);echo '</pre>';
    }
}

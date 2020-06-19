<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //表名
    protected $table = 'goods';
    //主键
    protected $primaryKey = 'goods_id';
    //时间戳
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
    //白名单
    //protected $fillable = [];
}

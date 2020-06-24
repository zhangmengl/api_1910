<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //表名
    protected $table = 'p_users';
    //主键
    protected $primaryKey = 'user_id';
    //时间戳
    public $timestamps = false;
    //黑名单
    //protected $guarded = [];
    //白名单
    //protected $fillable = ["user_name","email","password","reg_time"];
}

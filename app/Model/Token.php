<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //表名
    protected $table = 'p_token';
    //主键
    protected $primaryKey = 'id';
    //时间戳
    public $timestamps = false;
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function a()
    {
        echo __METHOD__;
    }

    public function b()
    {
        echo __METHOD__;
    }

    public function c()
    {
        echo __METHOD__;
    }

    public function d()
    {
        echo __METHOD__;
    }
}

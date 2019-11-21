<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegController extends Controller
{
    //
    public function index(){
        echo 'index';
    }

    public function dofrom(){
        dd(request()->post());
    }

    public function goods($goods_id){
        echo $goods_id;
    }
}

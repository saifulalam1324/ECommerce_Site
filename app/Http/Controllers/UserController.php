<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function HOME(){
        $data = DB::table('products')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function SHOWEACHPRODUCT(int $id){
        $data1 = DB::table('products')->where('product_id','=',$id)->get();
        return view('USER.EACHPRODUCT',['product1s'=>$data1]);

    }
    public function LOGINSIGNUP(){
        return view('USER.LOGINSIGNUP');
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    function HOME(){
        $data = DB::table('products')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    function LOGINSIGNUP(){
        return view('USER.LOGINSIGNUP');
    }

}

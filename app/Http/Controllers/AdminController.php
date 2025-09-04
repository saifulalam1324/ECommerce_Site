<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function ADMINHOME()
    {
        return view('ADMIN.HOME');
    }
    public function READUSERS()
    {
        $data = DB::table('customers')->orderBy('customer_id')->cursorPaginate(8);
        return view('ADMIN.ALLUSERS', ['customers' => $data]);
    }
    public function READVENDORS()
    {
        $data = DB::table('vendors')->orderBy('vendor_id')->cursorPaginate(8);
        return view('ADMIN.ALLVENDORS', ['vendors' => $data]);
    }
    public function READVENDORS1(int $id)
    {
        $data = DB::table('vendors')->where('vendor_id', $id)->get();
        return view('ADMIN.VENDORDETAILS', ['vendors' => $data]);
    }
}

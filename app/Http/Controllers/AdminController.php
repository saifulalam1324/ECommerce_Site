<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
    public function ADMINPROFILE(){
        return view('ADMIN.PROFILE');
    }
    public function ADMINSIGNUP(Request $request): RedirectResponse
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        $signup = DB::table('admins')->insert([
            'admin_name' => $request->admin_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($signup) {
            return redirect()->route('AdminLoginPage')->with('success', 'Registered successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }

    public function ADMINLOGIN(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('Admin home')->with('success', 'Welcome back, Admin!');
        }

        return back()->with('error', 'Invalid email or password. Please try again.');
    }


    public function ADMINLOGOUT(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('AdminLoginPage');
    }
    public function ADMINLOGINPAGE(){
        return view('ADMIN.ADMINLOGIN');
    }
    public function ADMINSIGNUPPAGE(){
        return view('ADMIN.ADMINSIGNUP');
    }

}

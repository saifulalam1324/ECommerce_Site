<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    function VENDORHOME()
    {
        return view('VENDORPANEL.HOME');
    }
    function ADDPRODUCT()
    {

        return view('VENDORPANEL.ADDPRODUCT');
    }
    public function STOREPRODUCT(Request $req): RedirectResponse
    {
        $vendorid=Auth::guard('vendor')->user()->vendor_id;
        $req->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'model' => 'required|string|max:100',
        ]);
        $storeProduct = DB::table('products')->insert([
            'product_name' => $req->product_name,
            'price' => $req->price,
            'description' => $req->description,
            'stock_quantity' => $req->stock,
            'vendor_id' => $vendorid,
            'category' => $req->category,
            'image_url' => $req->file('image')->store('image', 'public'),
            'created_at' => now(),
            'updated_at' => now(),
            'model' => $req->model
        ]);
        if ($storeProduct) {
            return redirect()->route('Add product')->with('success', 'Product added successfully!');
        } else {
            return redirect()->route('Add product')->with('error', 'Failed to add product. Please try again.');
        }
    }

    public function VENDORSIGNUP(Request $request): RedirectResponse
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|min:6',
        ]);

        $signup = DB::table('vendors')->insert([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'approve_status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($signup) {
            return redirect()->route('VendorLoginPage')->with('success', 'Registered successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }

    public function VENDORLOGIN(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            // 'approve_status'=>1,
        ]);
        $credentials['approve_status'] = 1;

        if (Auth::guard('vendor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('Vendor home')->with('success', 'Welcome back, Vendor!');
        }
        return back()->with('error', 'Your account is not approved yet or credentials are invalid.');
    }


    public function VENDORLOGOUT(Request $request)
    {
        Auth::guard('vendor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('VendorLoginPage');
    }
    public function VENDORLOGINPAGE()
    {
        return view('VENDORPANEL.VENDORLOGIN');
    }
    public function VENDORSIGNUPPAGE()
    {
        return view('VENDORPANEL.VENDORSIGNUP');
    }
       public function VENDORPROFILE(){
        return view('VENDORPANEL.PROFILE');
    }
}

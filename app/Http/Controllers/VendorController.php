<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function STOREPRODUCT(Request $req):RedirectResponse
    {
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
            'product_name' => $req->input('product_name'),
            'price' => $req->input('price'),
            'description' => $req->input('description'),
            'stock_quantity' => $req->input('stock'),
            'vendor_id' => 1,
            'category' => $req->input('category'),
            'image_url' => $req->file('image')->store('image', 'public'),
            'created_at' => now(),
            'updated_at' => now(),
            'model' => $req->input('model')
        ]);
        if ($storeProduct) {
            return redirect()->route('Add product')->with('success', 'Product added successfully!');
        } else {
            return redirect()->route('Add product')->with('error', 'Failed to add product. Please try again.');
        }
    }
}

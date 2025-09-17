<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function HOME()
    {
        $data = DB::table('products')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function SHOWEACHPRODUCT(int $id)
    {
        $data1 = DB::table('products')->where('product_id', '=', $id)->get();
        return view('USER.EACHPRODUCT', ['product1s' => $data1]);
    }
    public function LOGINSIGNUP()
    {
        return view('USER.LOGINSIGNUP');
    }

    public function USERSIGNUP(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
            'phone'    => 'required',
            'address'  => 'required',
        ]);

        $signup = DB::table('customers')->insert([
            'full_name' => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone_number'  => $request->phone,
            'address'       => $request->address,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        if ($signup) {
            return redirect()->route('LoginSignup')->with('success', 'Registered successfully! Please login.');
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }
    public function USERLOGIN(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('User home')->with('success', 'Welcome back, Vendor!');
        }
        return back()->with('error', 'Your account is not approved yet or credentials are invalid.');
    }
    public function USERLOGOUT(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('User home');
    }

    public function CART()
    {
        $cart = session()->get('cart', []);
        return view('USER.CART', compact('cart'));
    }
    public function ADDTOCART(Request $request, $id)
    {
        $product = DB::table('products')->where('product_id', $id)->first();

        if (! $product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        $cart = session()->get('cart', []);
        $quantity = max(1, (int)$request->input('quantity', 1));

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id'       => $product->product_id,
                'name'     => $product->product_name,
                'price'    => $product->price,
                'quantity' => $quantity,
                'image'    => $product->image_url,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
    public function INCREASE($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return back();
    }
    public function DECREASE($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }

        return back();
    }
    public function REMOVECART(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('Cart');
    }

    public function USERINFO()
    {
        return view('USER.USERINFO');
    }
}

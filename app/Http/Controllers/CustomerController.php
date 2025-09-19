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

    public function PLACEORDER(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $userId = auth()->guard('customer')->id();

        $grand = 0;
        foreach ($cart as $pid => $item) {
            $vendorId = DB::table('products')
                ->where('product_id', $pid)
                ->value('vendor_id');
            DB::table('orders')->insert([
                'customer_id' => $userId,
                'vendor_id'   => $vendorId,
                'product_id'  => $pid,
                'quantity'    => $item['quantity'],
                'price'       => $item['price'],
                'total'       => $item['price'] * $item['quantity'],
                'status'      => 0,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
            $grand += $item['price'] * $item['quantity'];
        }
        session()->put('grand_total', $grand);
        session()->forget('cart');

        return redirect()->route('Paymentpage')->with('success', 'Proceed to payment.');
    }
    public function SHOWPAYMENTPAGE()
    {
        $grand = session('grand_total', 0);
        return view('USER.PAYMENT', compact('grand'));
    }
    // public function processPayment(Request $request)
    // {
    //     $grand = session('grand_total', 0);
    //     $userId = auth()->guard('customer')->id();

    //     \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //     try {
    //         $charge = \Stripe\Charge::create([
    //             'amount' => $grand * 100,
    //             'currency' => 'usd',
    //             'description' => 'Order Payment',
    //             'source' => $request->Token,
    //         ]);
    //     } catch (\Exception $e) {
    //         \Illuminate\Support\Facades\Log::error('Stripe error: ' . $e->getMessage());
    //         return back()->with('error', 'Payment failed: ' . $e->getMessage());
    //     }
    //     $orders = DB::table('orders')
    //         ->where('customer_id', $userId)
    //         ->where('status', 0)
    //         ->get();

    //     foreach ($orders as $order) {
    //         DB::table('orders')
    //             ->where('order_id', $order->order_id)
    //             ->update(['status' => 1]);

    //         DB::table('products')
    //             ->where('product_id', $order->product_id)
    //             ->decrement('stock_quantity', $order->quantity);
    //     }
    //     session()->forget('grand_total');

    //     return redirect()->route('User home')->with('success', 'Payment successful! Your order is confirmed.');
    // }
    public function ORDERS()
    {
        $userId = auth()->guard('customer')->id();
        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.customer_id', $userId)
            ->select('orders.*', 'products.product_name', 'products.image_url')
            ->orderBy('orders.created_at', 'desc')
            ->get();
    }
    public function Payment(Request $request)
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $userId = auth()->guard('customer')->id();

        $charge = $stripe->charges->create([
            'amount'      => $request->price * 100,
            'currency'    => 'usd',
            'source'      => $request->stripeToken,
            'description' => 'Test Charge',
        ]);
        $orders = DB::table('orders')
            ->where('customer_id', $userId)
            ->where('status', 0)
            ->get();
        $orders = DB::table('orders')
            ->where('customer_id', $userId)
            ->where('status', 0)
            ->get();

        foreach ($orders as $order) {
            DB::table('orders')
                ->where('order_id', $order->order_id)
                ->update(['status' => 1]);

            DB::table('products')
                ->where('product_id', $order->product_id)
                ->decrement('stock_quantity', $order->quantity);
        }
        session()->forget('grand_total');

        return redirect()->route('User home')->with('success', 'Payment successful! Your order is confirmed.');
    }
}

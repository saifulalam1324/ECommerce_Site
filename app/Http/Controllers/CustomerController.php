<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    public function HOME()
    {
        $data = DB::table('products')->whereNotNull('discount')->get();
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
                'discount' => $product->discount ?? 0,
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
            return back()->with('error', 'Your cart is empty.');
        }

        $userId = auth()->guard('customer')->id();
        $grand  = 0;
        $grand1 = 0;
        $batchId = uniqid('order_', true);

        foreach ($cart as $pid => $item) {
            $product = DB::table('products')
                ->select('vendor_id', 'discount')
                ->where('product_id', $pid)
                ->first();

            $vendorId = $product->vendor_id;
            $discount = $product->discount ?? 0;
            $lineTotal = $item['price'] * $item['quantity'];
            $grand += $lineTotal;
            $discountedLineTotal = $lineTotal;
            if ($discount > 0) {
                $discountedLineTotal = $lineTotal - ($lineTotal * ($discount / 100));
            }
            $grand1 += $discountedLineTotal;

            DB::table('orders')->insert([
                'order_batch_id'   => $batchId,
                'customer_id'      => $userId,
                'vendor_id'        => $vendorId,
                'product_id'       => $pid,
                'quantity'         => $item['quantity'],
                'price'            => $item['price'],
                'total'            => $lineTotal,
                'discounted_tota' => $discountedLineTotal,
                'status'           => 0,
                'delivery_status'  => 'Pending',
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
        session()->put([
            'grand_total'      => $grand,
            'grand_total_disc' => $grand1,
            'order_batch'      => $batchId,
        ]);

        session()->forget('cart');

        return redirect()->route('Paymentpage')
            ->with('success', 'Proceed to payment.');
    }

    public function SHOWPAYMENTPAGE()
    {
        $grand = session('grand_total_disc', session('grand_total', 0));
        return view('USER.PAYMENT', compact('grand'));
    }

    public function Payment(Request $request)
    {
        $batchId = session('order_batch');
        $userId  = auth()->guard('customer')->id();
        $amount  = session('grand_total_disc', session('grand_total', 0));
        if (! $batchId || $amount <= 0) {
            return back()->with('error', 'No pending order found.');
        }

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $stripe->charges->create([
            'amount'      => $amount * 100,
            'currency'    => 'usd',
            'source'      => $request->stripeToken,
            'description' => 'Order Payment: ' . $batchId,
        ]);

        $orders = DB::table('orders')
            ->where('customer_id', $userId)
            ->where('order_batch_id', $batchId)
            ->where('status', 0)
            ->get();

        foreach ($orders as $order) {
            DB::table('orders')
                ->where('order_id', $order->order_id)
                ->update(['status' => 1, 'created_at' => now()]);

            DB::table('products')
                ->where('product_id', $order->product_id)
                ->decrement('stock_quantity', $order->quantity);
        }

        session()->forget(['grand_total', 'grand_total_disc', 'order_batch']);

        return redirect()->route('Orders')
            ->with('success', 'Payment successful! Your order is confirmed.');
    }


    public function SEARCH()
    {
        return view('USER.SEARCH');
    }

    public function BATCHORDERSPENDING()
    {
        $userId = Auth::guard('customer')->user()->customer_id;
        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
            ->where('orders.customer_id', $userId)
            ->where('orders.status', 1)
            ->where('orders.delivery_status', '=', 'Pending')
            ->select(
                'orders.order_batch_id',
                'orders.created_at',
                'orders.total',
                'orders.discounted_tota',
                'products.product_id',
                'products.product_name',
                'products.image_url',
                'orders.delivery_status',
                'orders.quantity',
                'orders.price',
                'vendors.company_name'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get()
            ->groupBy('order_batch_id')
            ->map(function ($batch) {
                $batch_discounted_total = $batch->sum('discounted_tota');
                return [
                    'created_at' => $batch->first()->created_at,
                    'batch_total' => $batch->sum('total'),
                    'batch_discounted_total' => $batch_discounted_total,
                    'items' => $batch->map(function ($row) {
                        return [
                            'product_id'      => $row->product_id,
                            'product_name'    => $row->product_name,
                            'image_url'       => $row->image_url,
                            'quantity'        => $row->quantity,
                            'price'           => $row->price,
                            'line_total'      => $row->total,
                            'discounted_total' => $row->discounted_tota,
                            'delivery_status' => $row->delivery_status,
                            'vendor_name'     => $row->company_name,
                        ];
                    })
                ];
            });

        return view('USER.ORDERS', ['batches' => $ordersByBatch]);
    }


    public function BATCHORDERSDONE()
    {
        $userId = Auth::guard('customer')->user()->customer_id;
        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
            ->where('orders.customer_id', $userId)
            ->where('orders.status', 1)
            ->where('orders.delivery_status', '=', 'Delivered')
            ->select(
                'orders.order_batch_id',
                'orders.created_at',
                'orders.total',
                'orders.discounted_tota',
                'products.product_id',
                'products.product_name',
                'products.image_url',
                'orders.delivery_status',
                'orders.quantity',
                'orders.price',
                'vendors.company_name'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get()
            ->groupBy('order_batch_id')
            ->map(function ($batch) {
                $batch_discounted_total = $batch->sum('discounted_tota');
                return [
                    'created_at' => $batch->first()->created_at,
                    'batch_total' => $batch->sum('total'),
                    'batch_discounted_total' => $batch_discounted_total,
                    'items' => $batch->map(function ($row) {
                        return [
                            'product_id'      => $row->product_id,
                            'product_name'    => $row->product_name,
                            'image_url'       => $row->image_url,
                            'quantity'        => $row->quantity,
                            'price'           => $row->price,
                            'line_total'      => $row->total,
                            'discounted_total' => $row->discounted_tota,
                            'delivery_status' => $row->delivery_status,
                            'vendor_name'     => $row->company_name,
                        ];
                    })
                ];
            });
        return view('USER.ORDERS', ['batches' => $ordersByBatch]);
    }

    public function GETPDF($batchId)
    {
        $batch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
            ->where('orders.order_batch_id', $batchId)
            ->select(
                'orders.order_batch_id',
                'orders.created_at',
                'orders.total',
                'products.product_id',
                'products.product_name',
                'products.image_url',
                'orders.delivery_status',
                'orders.quantity',
                'orders.price',
                'vendors.company_name'
            )
            ->get();

        $pdf = Pdf::loadView('USER.PDF', ['batches' => [$batchId => $batch]]);
        return $pdf->download($batchId . '.pdf');
    }

    public function TOTALTRANSACTION()
    {
        $userId = Auth::guard('customer')->user()->customer_id;
        $ordersByBatch = DB::table('orders')
            ->where('customer_id', $userId)
            ->where('status', 1)
            ->select('order_batch_id', 'orders.total', 'orders.price', 'orders.discounted_tota')
            ->orderBy('orders.created_at', 'desc')
            ->get()
            ->groupBy('order_batch_id')
            ->map(function ($batch) {
                $batch_total = $batch->sum('total');
                $batch_discounted_total = $batch->sum('discounted_tota');
                return [
                    'batch_total' => $batch_total,
                    'batch_discounted_total' => $batch_discounted_total,
                    'items' => $batch->map(function ($row) {
                        return [
                            'price'      => $row->price,
                            'line_total' => $row->total,
                            'discounted_total' => $row->discounted_tota,
                        ];
                    })
                ];
            });
        return view('USER.TRANSACTIONS', ['batches' => $ordersByBatch]);
    }

    public function SHOWCHANGEPASS()
    {
        return view('USER.CHANGEPASSWORD');
    }
    public function CHANGEPASS(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('customer')->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
    public function SHOWUPDATEPAGE()
    {
        return view('USER.UPDATEPROFILE');
    }

    public function UPDATEPROFILE(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);
        $customer = Auth::guard('customer')->user();
        $customer->full_name = $request->name;
        $customer->phone_number = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function COUNTORDERS(){
        $userId=Auth::guard('customer')->user()->customer_id;
        $count=DB::table('orders')->where('status','1')->count();
        return view('USER.User',['counts' => $count]);
    }

    public function GETAC()
    {
        $data = DB::table('products')->where('category', 'Ac')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETTV()
    {
        $data = DB::table('products')->where('category', 'Tv')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETAIRCOLLER()
    {
        $data = DB::table('products')->where('category', 'Air Coller')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETFRIDGE()
    {
        $data = DB::table('products')->where('category', 'Fridge')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETWASHINGMACHINE()
    {
        $data = DB::table('products')->where('category', 'Washing Machine')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETOVEN()
    {
        $data = DB::table('products')->where('category', 'Oven')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETBLENDER()
    {
        $data = DB::table('products')->where('category', 'Blender')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETDISHWASHER()
    {
        $data = DB::table('products')->where('category', 'Dish Washer')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETCHYMNI()
    {
        $data = DB::table('products')->where('category', 'Chymni')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETELECTRICSTOVE()
    {
        $data = DB::table('products')->where('category', 'Electriv Stove')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETRICECOOKER()
    {
        $data = DB::table('products')->where('category', 'Rice Cooker')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETCELLINGFAN()
    {
        $data = DB::table('products')->where('category', 'Celling Fan')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETTOASTER()
    {
        $data = DB::table('products')->where('category', 'Toaster')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETVACUUMCLEANER()
    {
        $data = DB::table('products')->where('category', 'Vacuum Cleaner')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETWATERHEATER()
    {
        $data = DB::table('products')->where('category', 'Water Heater')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETBULB()
    {
        $data = DB::table('products')->where('category', 'Bulb')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETIRON()
    {
        $data = DB::table('products')->where('category', 'Iron')->get();
        return view('USER.HOME', ['products' => $data]);
    }
    public function GETAIRPURIFIER()
    {
        $data = DB::table('products')->where('category', 'Air Purifier')->get();
        return view('USER.HOME', ['products' => $data]);
    }
}

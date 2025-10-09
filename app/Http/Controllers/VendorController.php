<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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
        $vendorid = Auth::guard('vendor')->user()->vendor_id;
        $req->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'model' => 'required|string|max:100',
            'discount' => 'min:0',
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
            'model' => $req->model,
            'discount' => $req->discount,
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
    public function VENDORPROFILE()
    {
        return view('VENDORPANEL.PROFILE');
    }

    public function BATCHORDERS()
    {
        $vendorid = Auth::guard('vendor')->user()->vendor_id;
        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorid)
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
                            'product_id'   => $row->product_id,
                            'product_name' => $row->product_name,
                            'image_url'    => $row->image_url,
                            'quantity'     => $row->quantity,
                            'price'        => $row->price,
                            'line_total'   => $row->total,
                            'discounted_total' => $row->discounted_tota,
                            'delivery_status' => $row->delivery_status,
                        ];
                    })
                ];
            });
        return view('VENDORPANEL.VENDORORDERS', ['batches' => $ordersByBatch]);
    }

    public function BATCHORDERSSHIPPED()
    {
        $vendorid = Auth::guard('vendor')->user()->vendor_id;
        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorid)
            ->where('orders.status', 1)
            ->where('orders.delivery_status', '=', 'Shipped')
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
                            'product_id'   => $row->product_id,
                            'product_name' => $row->product_name,
                            'image_url'    => $row->image_url,
                            'quantity'     => $row->quantity,
                            'price'        => $row->price,
                            'line_total'   => $row->total,
                            'discounted_total' => $row->discounted_tota,
                            'delivery_status' => $row->delivery_status,
                        ];
                    })
                ];
            });
        return view('VENDORPANEL.SHIPPEDORDERS', ['batches' => $ordersByBatch]);
    }

    public function BATCHORDERSSHIPPEDDONE()
    {
        $vendorid = Auth::guard('vendor')->user()->vendor_id;
        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorid)
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
                            'product_id'   => $row->product_id,
                            'product_name' => $row->product_name,
                            'image_url'    => $row->image_url,
                            'quantity'     => $row->quantity,
                            'price'        => $row->price,
                            'line_total'   => $row->total,
                            'discounted_total' => $row->discounted_tota,
                            'delivery_status' => $row->delivery_status,
                        ];
                    })
                ];
            });
        return view('VENDORPANEL.SHIPPEDORDERS', ['batches' => $ordersByBatch]);
    }

    public function PRODUCTS()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')->where('vendor_id', $vendorID)->orderBy('product_id')->cursorPaginate(10);
        return view('VENDORPANEL.OWNPRODUCT', ['products' => $data]);
    }

    public function WIPEOUTPRODUCT($productID)
    {
        $deleteProduct = DB::table('products')->where('product_id', $productID)->delete();
        return redirect()->back()->with('success', 'Product Wiped Out successfully!');
    }

    public function STOCKOUTPRODUCT()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')->where('vendor_id', $vendorID)->where('stock_quantity', '<=', '0')->orderBy('product_id')->cursorPaginate(10);
        return view('VENDORPANEL.STOCKOUTPRODUCTS', ['Products' => $data]);
    }
    public function GETACV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Ac')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.AC', ['products' => $data]);
    }

    public function GETAirCoolerV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Air Cooler')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.AIRCOOLER', ['products' => $data]);
    }

    public function GETTVV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Tv')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.TV', ['products' => $data]);
    }

    public function GETFridgeV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Fridge')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.FRIDGE', ['products' => $data]);
    }

    public function GETWashingMachineV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Washing Machine')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.WASHINGMACHINE', ['products' => $data]);
    }

    public function GETOvenV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Oven')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.OVEN', ['products' => $data]);
    }

    public function GETBlenderV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Blender')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.BLENDER', ['products' => $data]);
    }

    public function GETDishWasherV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Dish Washer')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.DISHWASHER', ['products' => $data]);
    }

    public function GETChimneyV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Chimney')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.CHYMNI', ['products' => $data]);
    }

    public function GETElectricStoveV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Electric Stove')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.ELECTRICSTOVE', ['products' => $data]);
    }

    public function GETRiceCookerV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Rice Cooker')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.RICECOOKER', ['products' => $data]);
    }

    public function GETCeilingFanV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Ceiling Fan')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.CELLINGFAN', ['products' => $data]);
    }

    public function GETToasterV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Toaster')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.TOASTER', ['products' => $data]);
    }

    public function GETVacuumCleanerV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Vacuum Cleaner')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.VACUUMCLEANER', ['products' => $data]);
    }

    public function GETWaterHeaterV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Water Heater')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.WATERHEATER', ['products' => $data]);
    }

    public function GETBulbV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Bulb')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.BULB', ['products' => $data]);
    }

    public function GETIronV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Iron')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.IRON', ['products' => $data]);
    }

    public function GETAirPurifierV()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $data = DB::table('products')
            ->where('vendor_id', $vendorID)
            ->where('category', 'Air Purifier')
            ->orderBy('product_id', 'desc')
            ->cursorPaginate(30);
        return view('VENDORPANEL.AIRPURIFIER', ['products' => $data]);
    }


    public function RESTOCK(Request $request, $id)
    {
        $request->validate([
            'stock'     => 'required|integer|min:0',
        ]);
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $restock = DB::table('products')->where('vendor_id', $vendorID)->where('product_id', $id)->update(['stock_quantity' => $request->stock]);
        return back()->with('success', 'Restocked Successfully');
    }

    public function VIEWUPDATEPRODUCTPAGE($productid)
    {
        $products = DB::table('products')->where('product_id', $productid)->first();
        return view('VENDORPANEL.UPDATEPRODUCTINFO', ['product' => $products]);
    }
    public function UPDATEPRODUCTINFO(Request $request, $productid)
    {
        $request->validate([
            'product_name' => 'string|max:255',
            'price'        => 'numeric',
            'description'  => 'string',
            'stock'        => 'integer|min:0',
            'model'        => 'string|max:100',
        ]);

        $product = DB::table('products')->where('product_id', $productid)->first();
        $newstock = $product->stock_quantity + $request->stock;

        DB::table('products')->where('product_id', $productid)->update([
            'product_name'   => $request->product_name,
            'price'          => $request->price,
            'description'    => $request->description,
            'stock_quantity' => $newstock,
            'model'          => $request->model,
        ]);

        return back()->with('success', 'Updated Successfully');
    }

    public function COUNTITEMSALE()
    {
        $vendorID = Auth::guard('vendor')->user()->vendor_id;
        $Ac = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Ac')
            ->count();

        $Aicooler = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Air Cooler')
            ->count();

        $Tv = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Tv')
            ->count();

        $Fridge = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Fridge')
            ->count();

        $Washingmachine = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Washing Machine')
            ->count();

        $Oven = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Oven')
            ->count();

        $Blender = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Blender')
            ->count();

        $Dishwasher = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Dish Washer')
            ->count();

        $Chimney = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Chimney')
            ->count();

        $Electricstove = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Electric Stove')
            ->count();

        $Ricecooker = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Rice Cooker')
            ->count();

        $Ceillingfan = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Ceiling Fan')
            ->count();

        $Toaster = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Toaster')
            ->count();

        $Vacuumcleaner = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Vacuum Cleaner')
            ->count();

        $waterheater = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Water Heater')
            ->count();

        $Bulb = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Bulb')
            ->count();

        $Iron = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Iron')
            ->count();

        $Airpurifier = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Air Purifier')
            ->count();

        $Acc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Ac')
            ->sum('orders.discounted_tota');

        $Aicoolerc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Air Cooler')
            ->sum('orders.discounted_tota');

        $Tvc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Tv')
            ->sum('orders.discounted_tota');

        $Fridgec = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Fridge')
            ->sum('orders.discounted_tota');

        $Washingmachinec = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Washing Machine')
            ->sum('orders.discounted_tota');

        $Ovenc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Oven')
            ->sum('orders.discounted_tota');

        $Blenderc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Blender')
            ->sum('orders.discounted_tota');

        $Dishwasherc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Dish Washer')
            ->sum('orders.discounted_tota');

        $Chimneyc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Chimney')
            ->sum('orders.discounted_tota');

        $Electricstovec = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Electric Stove')
            ->sum('orders.discounted_tota');

        $Ricecookerc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Rice Cooker')
            ->sum('orders.discounted_tota');

        $Ceillingfanc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Ceiling Fan')
            ->sum('orders.discounted_tota');

        $Toasterc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Toaster')
            ->sum('orders.discounted_tota');

        $Vacuumcleanerc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Vacuum Cleaner')
            ->sum('orders.discounted_tota');

        $waterheaterc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Water Heater')
            ->sum('orders.discounted_tota');

        $Bulbc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Bulb')
            ->sum('orders.discounted_tota');

        $Ironc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Iron')
            ->sum('orders.discounted_tota');

        $Airpurifierc = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->where('orders.vendor_id', $vendorID)
            ->where('orders.status', 1)
            ->where('products.category', 'Air Purifier')
            ->sum('orders.discounted_tota');

        $year = date('Y');
        $monthlySales = [];
        for ($month = 1; $month <= 12; $month++) {
            $total = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.product_id')
                ->where('orders.vendor_id', $vendorID)
                ->where('orders.status', 1)
                ->whereYear('orders.created_at', $year)
                ->whereMonth('orders.created_at', $month)
                ->sum('orders.discounted_tota');
            $monthlySales[] = $total;
        }


        $sumc = $Acc + $Aicoolerc + $Tvc + $Fridgec + $Washingmachinec + $Ovenc + $Blenderc + $Dishwasherc + $Chimneyc + $Electricstovec + $Ricecookerc + $Ceillingfanc + $Toasterc + $Vacuumcleanerc + $waterheaterc + $Bulbc + $Ironc + $Airpurifierc;
        $total = $Ac + $Aicooler + $Tv + $Fridge + $Washingmachine + $Oven + $Blender + $Dishwasher + $Chimney + $Electricstove + $Ricecooker + $Ceillingfan + $Toaster + $Vacuumcleaner + $waterheater + $Bulb + $Iron + $Airpurifier;
        return view('VENDORPANEL.HOME', compact(
            'Ac',
            'Aicooler',
            'Tv',
            'Fridge',
            'Washingmachine',
            'Oven',
            'Blender',
            'Dishwasher',
            'Chimney',
            'Electricstove',
            'Ricecooker',
            'Ceillingfan',
            'Toaster',
            'Vacuumcleaner',
            'waterheater',
            'Bulb',
            'Iron',
            'Airpurifier',
            'total',
            'Acc',
            'Aicoolerc',
            'Tvc',
            'Fridgec',
            'Washingmachinec',
            'Ovenc',
            'Blenderc',
            'Dishwasherc',
            'Chimneyc',
            'Electricstovec',
            'Ricecookerc',
            'Ceillingfanc',
            'Toasterc',
            'Vacuumcleanerc',
            'waterheaterc',
            'Bulbc',
            'Ironc',
            'Airpurifierc',
            'sumc',
            'monthlySales'
        ));
    }


    public function SHOWCHANGEPASSV()
    {
        return view('VENDORPANEL.CHANGEPASSWORD');
    }
    public function CHANGEPASSV(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $vendor = Auth::guard('vendor')->user();
        if (!Hash::check($request->current_password, $vendor->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        $vendor->password = Hash::make($request->new_password);
        $vendor->save();

        return back()->with('success', 'Password changed successfully!');
    }
}

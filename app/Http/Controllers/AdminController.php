<?php

namespace App\Http\Controllers;

use App\Mail\AttachmentEmail;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function ADMINHOME()
    {
        return view('ADMIN.HOME');
    }
    public function ADMINLOGINPAGE()
    {
        return view('ADMIN.ADMINLOGIN');
    }
    public function ADMINSIGNUPPAGE()
    {
        return view('ADMIN.ADMINSIGNUP');
    }
    public function READUSERS()
    {
        $data = DB::table('customers')->orderBy('customer_id')->cursorPaginate(20);
        return view('ADMIN.ALLUSERS', ['customers' => $data]);
    }
    public function READVENDORS()
    {
        $vendors = DB::table('vendors')->where('approve_status', 1)
            ->leftJoin('orders', 'vendors.vendor_id', '=', 'orders.vendor_id')
            ->select(
                'vendors.vendor_id',
                'vendors.company_name',
                'vendors.email',
                'vendors.created_at',
                'vendors.updated_at',
                DB::raw('COALESCE(SUM(orders.discounted_tota), 0) AS total_sale')
            )
            ->groupBy(
                'vendors.vendor_id',
                'vendors.company_name',
                'vendors.email',
                'vendors.created_at',
                'vendors.updated_at'
            )
            ->orderBy('vendors.vendor_id', 'asc')
            ->paginate(20);

        return view('ADMIN.ALLVENDORS', ['vendors' => $vendors]);
    }

    public function ADMINPROFILE()
    {
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
    public function VENDORREQUESTS()
    {
        $data = DB::table('vendors')->where('approve_status', '=', '0')->orderBy('vendor_id')->cursorPaginate(8);
        return view('ADMIN.VENDORSREQUESTS', ['vendors' => $data]);
    }

    public function UPDATEAPPROVESTATUS(int $id)
    {
        $data = DB::table('vendors')->where('vendor_id', '=', $id)->update(['approve_status' => 1]);
        return redirect()->back()->with('success', 'Vendor approved successfully!');
    }
    public function DELETEREQUEST(int $id)
    {
        $data = DB::table('vendors')->where('vendor_id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Vendor request deleted successfully!');
    }
    public function BATCHORDERSALL()
    {
        $count = DB::table('orders')->where('delivery_status', 'Pending')->count();
        if ($count == 0) {
            return view('ADMIN.ADMINORDERS', ['batches' => []])->with('info', 'No pending orders available.');
        }

        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
            ->join('customers', 'orders.customer_id', '=', 'customers.customer_id')
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
                'vendors.company_name',
                'vendors.email',
                'customers.customer_id',
                'customers.full_name',
                'customers.email as customer_email',
                'customers.phone_number',
                'customers.address'
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
                            'vendor_email'    => $row->email,
                            'customer_id'     => $row->customer_id,
                            'customer_name'   => $row->full_name,
                            'customer_email'  => $row->customer_email,
                            'customer_phone'  => $row->phone_number,
                            'customer_address' => $row->address,
                        ];
                    })
                ];
            });

        return view('ADMIN.ADMINORDERS', ['batches' => $ordersByBatch]);
    }


    public function UPDATEDELIVERYSTATUS(Request $request, $order_batch_id)
    {
        $orderdetails = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
            ->join('customers', 'orders.customer_id', '=', 'customers.customer_id')
            ->where('orders.status', 1)
            ->where('orders.delivery_status', '=', 'Pending')
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
                'orders.discounted_tota',
                'vendors.company_name',
                'vendors.email',
                'customers.customer_id',
                'customers.full_name as Name',
                'customers.email as customer_email',
                'customers.phone_number',
                'customers.address'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get();
        $customername = $orderdetails->first()->Name;
        $customerMail = $orderdetails->first()->customer_email;
        Mail::to($customerMail)->send(new AttachmentEmail($orderdetails, $customername));
        $updateStatus = DB::table('orders')
            ->where('order_batch_id', $order_batch_id)
            ->update(['delivery_status' => 'Shipped', 'updated_at' => now()]);
        if ($updateStatus) {
            return redirect()->route('AllOrders')->with('success', 'Delivery status updated successfully!');
        } else {
            return redirect()->route('AllOrders')->with('error', 'Failed to update delivery status. Please try again.');
        }
    }

    public function CompletedOrders()
    {
        $count = DB::table('orders')->where('delivery_status', 'Delivered')->count();
        if ($count == 0) {
            return view('ADMIN.COMPLETEDORDERS', ['batches' => []])->with('info', 'No completed orders available.');
        }
        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
            ->join('customers', 'orders.customer_id', '=', 'customers.customer_id')
            ->where('orders.status', 1)
            ->where('orders.delivery_status', '=', 'Delivered')
            ->select(
                'orders.order_batch_id',
                'orders.updated_at',
                'orders.total',
                'orders.discounted_tota',
                'products.product_id',
                'products.product_name',
                'products.image_url',
                'orders.delivery_status',
                'orders.quantity',
                'orders.price',
                'vendors.company_name',
                'vendors.email',
                'customers.customer_id',
                'customers.full_name',
                'customers.email as customer_email',
                'customers.phone_number',
                'customers.address'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get()
            ->groupBy('order_batch_id')
            ->map(function ($batch) {
                $batch_discounted_total = $batch->sum('discounted_tota');
                return [
                    'updated_at' => $batch->first()->updated_at,
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
                            'vendor_email'    => $row->email,
                            'customer_id'     => $row->customer_id,
                            'customer_name'   => $row->full_name,
                            'customer_email'  => $row->customer_email,
                            'customer_phone'  => $row->phone_number,
                            'customer_address' => $row->address,
                        ];
                    })
                ];
            });
        return view('ADMIN.COMPLETEDORDERS', ['batches' => $ordersByBatch]);
    }

    public function SHIPPEDORDERS()
    {
        $count = DB::table('orders')->where('delivery_status', 'Shipped')->count();
        if ($count == 0) {
            return view('ADMIN.SHIPPEDORDERS', ['batches' => []])->with('info', 'No shipped orders available.');
        }
        $ordersByBatch = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.product_id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.vendor_id')
            ->join('customers', 'orders.customer_id', '=', 'customers.customer_id')
            ->where('orders.status', 1)
            ->where('orders.delivery_status', '=', 'Shipped')
            ->select(
                'orders.order_batch_id',
                'orders.updated_at',
                'orders.total',
                'orders.discounted_tota',
                'products.product_id',
                'products.product_name',
                'products.image_url',
                'orders.delivery_status',
                'orders.quantity',
                'orders.price',
                'vendors.company_name',
                'vendors.email',
                'customers.customer_id',
                'customers.full_name',
                'customers.email as customer_email',
                'customers.phone_number',
                'customers.address'
            )
            ->orderBy('orders.created_at', 'desc')
            ->get()
            ->groupBy('order_batch_id')
            ->map(function ($batch) {
                $batch_discounted_total = $batch->sum('discounted_tota');
                return [
                    'updated_at' => $batch->first()->updated_at,
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
                            'vendor_email'    => $row->email,
                            'customer_id'     => $row->customer_id,
                            'customer_name'   => $row->full_name,
                            'customer_email'  => $row->customer_email,
                            'customer_phone'  => $row->phone_number,
                            'customer_address' => $row->address,
                        ];
                    })
                ];
            });
        return view('ADMIN.SHIPPEDORDERS', ['batches' => $ordersByBatch]);
    }


    public function UPDATEDELIVERYSTATUSDONE(Request $request, $order_batch_id)
    {
        $updateStatus = DB::table('orders')
            ->where('order_batch_id', $order_batch_id)
            ->update(['delivery_status' => 'Delivered', 'updated_at' => now()]);
        if ($updateStatus) {
            return redirect()->route('ShippedOrdersadmin')->with('success', 'Delivery status updated successfully!');
        } else {
            return redirect()->route('ShippedOrdersadmin')->with('error', 'Failed to update delivery status. Please try again.');
        }
    }
}

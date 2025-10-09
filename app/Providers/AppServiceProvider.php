<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
        View::composer('*', function ($view) {
            $counts = 0;
            if (Auth::guard('customer')->check()) {
                $userId = Auth::guard('customer')->user()->customer_id;
                $counts = DB::table('orders')
                    ->where('customer_id', $userId)
                    ->where('status', 1)
                    ->count();
            }
            $company = DB::table('vendors')->get();
            $view->with([
                'counts' => $counts,
                'company' => $company
            ]);
        });
    }
}

<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    /**
     * Display customer dashboard
     */
    public function index()
    {
        return view('customer.dashboard.index', [
            'customer' => auth()->user(),
            'stats' => [
                'total_orders' => 8,
                'pending_orders' => 2,
                'total_spent' => '₹25,000',
                'wishlist_items' => 5,
            ]
        ]);
    }
    
    /**
     * Display customer profile
     */
    public function profile()
    {
        return view('customer.profile.index', [
            'customer' => auth()->user()
        ]);
    }
}
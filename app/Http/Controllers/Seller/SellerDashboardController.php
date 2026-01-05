<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    /**
     * Display seller dashboard (NEW UI)
     */
    public function index()
    {
        $user = Auth::user();
        
        // Pass user data to view
        return view('seller.dashboard.index', [
            'user' => $user
        ]);
    }
    
    /**
     * Display orders page
     */
    public function orders()
    {
        return view('seller.orders.index');
    }
    
    /**
     * Display returns page
     */
    public function returns()
    {
        return view('seller.returns.index');
    }
    
    /**
     * Display inventory page
     */
    public function inventory()
    {
        return view('seller.inventory.index');
    }
    
    /**
     * Display profile page
     */
    public function profile()
    {
        $user = Auth::user();
        return view('seller.profile.index', compact('user'));
    }
}
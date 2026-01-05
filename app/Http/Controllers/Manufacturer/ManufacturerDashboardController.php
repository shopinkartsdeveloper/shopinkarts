<?php

namespace App\Http\Controllers\Manufacturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManufacturerDashboardController extends Controller
{
    /**
     * Display manufacturer dashboard (NEW UI)
     */
    public function index()
    {
        $user = Auth::user();
        
        // Pass user data to view
        return view('manufacturer.dashboard.index', [
            'user' => $user
        ]);
    }
    
    /**
     * Display orders page
     */
    public function orders()
    {
        return view('manufacturer.orders.index');
    }
    
    /**
     * Display returns page
     */
    public function returns()
    {
        return view('manufacturer.returns.index');
    }
    
    /**
     * Display profile page
     */
    public function profile()
    {
        $user = Auth::user();
        return view('manufacturer.profile.index', compact('user'));
    }
}
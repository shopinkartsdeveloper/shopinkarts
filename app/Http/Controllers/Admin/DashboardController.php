<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Check if user is admin
        if (!Auth::user()->hasRole('admin')) {
            return redirect()->route('login')
                ->with('error', 'You are not authorized to access admin dashboard.');
        }
        
        return view('admin.dashboard.index');
    }
}
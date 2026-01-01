<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SellerController extends Controller
{
    public function index()
    {
        return view('admin.sellers.index');
    }
    
    public function show($id)
    {
        return view('admin.sellers.show', ['sellerId' => $id]);
    }
}
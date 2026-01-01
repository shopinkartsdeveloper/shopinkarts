<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    public function index()
    {
        return view('admin.manufacturers.index');
    }
    
    public function show($id)
    {
        return view('admin.manufacturers.show', ['manufacturerId' => $id]);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->get(),
            'categories' => Category::where('is_active',1)->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'category_id'=>'required'
        ]);

        Product::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
            'price'=>$request->price,
            'hsn'=>$request->hsn,
            'category_id'=>$request->category_id
        ]);

        return back()->with('success','Product added');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','Product deleted');
    }
}

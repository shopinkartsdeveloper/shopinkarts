<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        // Get only non-deleted products
        $products = Product::with('category')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $totalProducts = Product::whereNull('deleted_at')->count();
        
        // Calculate stock statistics
        $inStockProducts = 0;
        $lowStockProducts = 0;
        
        try {
            $inStockProducts = Product::whereNull('deleted_at')
                ->where('stock_quantity', '>', 10)->count();
            $lowStockProducts = Product::whereNull('deleted_at')
                ->where('stock_quantity', '>', 0)
                ->where('stock_quantity', '<=', 10)
                ->count();
        } catch (\Exception $e) {
            // If column doesn't exist, use defaults
            $inStockProducts = Product::whereNull('deleted_at')->count();
        }
        
        $totalCategories = Category::count();
        
        $recentActivities = [
            [
                'icon' => 'box',
                'color' => '#4361ee',
                'title' => 'New product added',
                'description' => 'Katho_kurti_1 has been added to Ethnic Wear',
                'time' => '2 hours ago'
            ],
            [
                'icon' => 'edit',
                'color' => '#28a745',
                'title' => 'Product price updated',
                'description' => 'Red_Voke_kurti_1 price changed to ₹449',
                'time' => '4 hours ago'
            ],
            [
                'icon' => 'tag',
                'color' => '#17a2b8',
                'title' => 'Product category updated',
                'description' => 'Resin_levelery_1 assigned to Fashion Jewellery',
                'time' => '1 day ago'
            ]
        ];
        
        return view('admin.products.index', compact(
            'products',
            'totalProducts',
            'inStockProducts',
            'lowStockProducts',
            'totalCategories',
            'recentActivities'
        ));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'hsn_code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Generate unique slug to avoid duplicate error
        $slug = $this->generateUniqueSlug($validated['name']);
        
        $validated['slug'] = $slug;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }
    
    /**
     * Generate unique slug for product.
     */
    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;
        
        // Check if slug exists
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        
        return $slug;
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // Check if product is soft deleted
        if ($product->trashed()) {
            return redirect()->route('admin.products.index')
                ->with('error', 'This product has been deleted.');
        }
        
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        // Check if product is soft deleted
        if ($product->trashed()) {
            return redirect()->route('admin.products.index')
                ->with('error', 'This product has been deleted.');
        }
        
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'hsn_code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Generate new slug if name changed
        if ($product->name !== $validated['name']) {
            $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        }
        
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        
        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage (Soft Delete).
     */
    public function destroy(Product $product)
    {
        // Check if already deleted
        if ($product->trashed()) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Product is already deleted.');
        }
        
        $product->delete(); // This will soft delete

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully. You can restore it from trash if needed.');
    }

    /**
     * Show trashed products.
     */
    public function trash()
    {
        $trashedProducts = Product::onlyTrashed()
            ->with('category')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);
        
        return view('admin.products.trash', compact('trashedProducts'));
    }

    /**
     * Restore a soft deleted product.
     */
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        
        if (!$product->trashed()) {
            return redirect()->route('admin.products.trash')
                ->with('error', 'Product is not deleted.');
        }
        
        $product->restore();

        return redirect()->route('admin.products.trash')
            ->with('success', 'Product restored successfully.');
    }

    /**
     * Force delete a product (permanent delete).
     */
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        
        if (!$product->trashed()) {
            return redirect()->route('admin.products.trash')
                ->with('error', 'Product must be deleted first.');
        }
        
        $product->forceDelete();

        return redirect()->route('admin.products.trash')
            ->with('success', 'Product permanently deleted.');
    }
}
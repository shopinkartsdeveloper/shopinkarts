<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SellerController extends Controller
{
    /**
     * Display a listing of sellers
     */
    public function index()
    {
        $sellers = User::sellers()->withTrashed()->latest()->get();
        $totalSellers = User::sellers()->count();
        $activeSellers = User::sellers()->active()->count();
        $inactiveSellers = User::sellers()->inactive()->count();
        $pendingSellers = User::sellers()->pending()->count();
        
        return view('admin.sellers.index', compact(
            'sellers',
            'totalSellers',
            'activeSellers',
            'inactiveSellers',
            'pendingSellers'
        ));
    }
    
    /**
     * Show the form for creating a new seller
     */
    public function create()
    {
        return view('admin.sellers.create');
    }
    
    /**
     * Store a newly created seller
     */
    public function store(Request $request)
    {
        $request->validate(User::createRules());
        
        // Handle whatsapp number - if empty, use mobile number
        $whatsappNumber = $request->whatsapp_number;
        if (empty($whatsappNumber)) {
            $whatsappNumber = $request->mobile_number;
        }
        
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_number' => $request->mobile_number,
            'mobile' => $request->mobile_number,
            'email' => $request->email,
            'whatsapp_number' => $whatsappNumber,
            'firm_name' => $request->firm_name,
            'gst_number' => $request->gst_number,
            'shop_name' => $request->shop_name,
            'company_name' => $request->company_name ?? $request->firm_name,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'type' => 'seller',
        ]);
        
        // Assign seller role
        $sellerRole = Role::where('name', 'seller')->first();
        if ($sellerRole) {
            $user->assignRole($sellerRole);
        }
        
        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller created successfully!');
    }
    
    /**
     * Display the specified seller
     */
    public function show($id)
    {
        $seller = User::sellers()->withTrashed()->findOrFail($id);
        return view('admin.sellers.show', compact('seller'));
    }
    
    /**
     * Show the form for editing the specified seller
     */
    public function edit($id)
    {
        $seller = User::sellers()->withTrashed()->findOrFail($id);
        return view('admin.sellers.edit', compact('seller'));
    }
    
    /**
     * Update the specified seller
     */
    public function update(Request $request, $id)
    {
        $seller = User::sellers()->withTrashed()->findOrFail($id);
        
        $request->validate(User::updateRules($seller->id));
        
        // Handle whatsapp number - if empty, use mobile number
        $whatsappNumber = $request->whatsapp_number;
        if (empty($whatsappNumber)) {
            $whatsappNumber = $request->mobile_number;
        }
        
        $updateData = [
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_number' => $request->mobile_number,
            'mobile' => $request->mobile_number,
            'email' => $request->email,
            'whatsapp_number' => $whatsappNumber,
            'firm_name' => $request->firm_name,
            'gst_number' => $request->gst_number,
            'shop_name' => $request->shop_name,
            'company_name' => $request->company_name ?? $request->firm_name,
            'status' => $request->status,
        ];
        
        // Update password if provided
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed'
            ]);
            $updateData['password'] = Hash::make($request->password);
        }
        
        $seller->update($updateData);
        
        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller updated successfully!');
    }
    
    /**
     * Soft delete the specified seller
     */
    public function destroy($id)
    {
        $seller = User::sellers()->findOrFail($id);
        $seller->delete();
        
        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller soft deleted successfully!');
    }
    
    /**
     * Restore a soft deleted seller
     */
    public function restore($id)
    {
        $seller = User::sellers()->withTrashed()->findOrFail($id);
        $seller->restore();
        
        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller restored successfully!');
    }
    
    /**
     * Permanently delete a seller
     */
    public function forceDelete($id)
    {
        $seller = User::sellers()->withTrashed()->findOrFail($id);
        $seller->forceDelete();
        
        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller permanently deleted!');
    }
}
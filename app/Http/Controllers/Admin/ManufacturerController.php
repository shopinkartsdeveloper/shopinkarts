<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of manufacturers
     */
    public function index()
    {
        $manufacturers = User::manufacturers()->withTrashed()->latest()->get();
        $totalManufacturers = User::manufacturers()->count();
        $activeManufacturers = User::manufacturers()->active()->count();
        $inactiveManufacturers = User::manufacturers()->inactive()->count();
        $pendingManufacturers = User::manufacturers()->pending()->count();
        
        return view('admin.manufacturers.index', compact(
            'manufacturers',
            'totalManufacturers',
            'activeManufacturers',
            'inactiveManufacturers',
            'pendingManufacturers'
        ));
    }
    
    /**
     * Show the form for creating a new manufacturer
     */
    public function create()
    {
        return view('admin.manufacturers.create');
    }
    
    /**
     * Store a newly created manufacturer
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
            'type' => 'manufacturer',
        ]);
        
        // Assign manufacturer role
        $manufacturerRole = Role::where('name', 'manufacturer')->first();
        if ($manufacturerRole) {
            $user->assignRole($manufacturerRole);
        }
        
        return redirect()->route('admin.manufacturers.index')
            ->with('success', 'Manufacturer created successfully!');
    }
    
    /**
     * Display the specified manufacturer
     */
    public function show($id)
    {
        $manufacturer = User::manufacturers()->withTrashed()->findOrFail($id);
        return view('admin.manufacturers.show', compact('manufacturer'));
    }
    
    /**
     * Show the form for editing the specified manufacturer
     */
    public function edit($id)
    {
        $manufacturer = User::manufacturers()->withTrashed()->findOrFail($id);
        return view('admin.manufacturers.edit', compact('manufacturer'));
    }
    
    /**
     * Update the specified manufacturer
     */
    public function update(Request $request, $id)
    {
        $manufacturer = User::manufacturers()->withTrashed()->findOrFail($id);
        
        $request->validate(User::updateRules($manufacturer->id));
        
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
        
        $manufacturer->update($updateData);
        
        return redirect()->route('admin.manufacturers.index')
            ->with('success', 'Manufacturer updated successfully!');
    }
    
    /**
     * Soft delete the specified manufacturer
     */
    public function destroy($id)
    {
        $manufacturer = User::manufacturers()->findOrFail($id);
        $manufacturer->delete();
        
        return redirect()->route('admin.manufacturers.index')
            ->with('success', 'Manufacturer soft deleted successfully!');
    }
    
    /**
     * Restore a soft deleted manufacturer
     */
    public function restore($id)
    {
        $manufacturer = User::manufacturers()->withTrashed()->findOrFail($id);
        $manufacturer->restore();
        
        return redirect()->route('admin.manufacturers.index')
            ->with('success', 'Manufacturer restored successfully!');
    }
    
    /**
     * Permanently delete a manufacturer
     */
    public function forceDelete($id)
    {
        $manufacturer = User::manufacturers()->withTrashed()->findOrFail($id);
        $manufacturer->forceDelete();
        
        return redirect()->route('admin.manufacturers.index')
            ->with('success', 'Manufacturer permanently deleted!');
    }
}
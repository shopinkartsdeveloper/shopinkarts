<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'mobile_number',
        'whatsapp_number',
        'firm_name',
        'gst_number',
        'shop_name',
        'company_name',
        'password',
        'status',
        'profile_image',
        'address',
        'city',
        'state',
        'pincode',
        'country',
        'type',
        'mobile',
        'mobile_verified_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $dates = ['deleted_at'];

    // Validation rules for creation
    public static function createRules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15|unique:users,mobile_number',
            'email' => 'required|email|unique:users,email',
            'whatsapp_number' => 'nullable|string|max:15',
            'firm_name' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:20',
            'shop_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|in:active,inactive,pending'
        ];
    }

    // Validation rules for update
    public static function updateRules($userId)
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:15|unique:users,mobile_number,' . $userId,
            'email' => 'required|email|unique:users,email,' . $userId,
            'whatsapp_number' => 'nullable|string|max:15',
            'firm_name' => 'required|string|max:255',
            'gst_number' => 'nullable|string|max:20',
            'shop_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,pending'
        ];
    }

    // Get full name
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Check if user is seller
    public function isSeller()
    {
        return $this->hasRole('seller');
    }

    // Check if user is manufacturer
    public function isManufacturer()
    {
        return $this->hasRole('manufacturer');
    }

    // Check if user is admin
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    // Check if user is staff
    public function isStaff()
    {
        return $this->hasRole('staff');
    }

    // Check if user is customer
    public function isCustomer()
    {
        return $this->hasRole('customer');
    }

    // Check if user can login
    public function canLogin()
    {
        return $this->status === 'active' && !$this->trashed();
    }

    // Scope for sellers
    public function scopeSellers($query)
    {
        return $query->whereHas('roles', function($q) {
            $q->where('name', 'seller');
        });
    }

    // Scope for manufacturers
    public function scopeManufacturers($query)
    {
        return $query->whereHas('roles', function($q) {
            $q->where('name', 'manufacturer');
        });
    }

    // Scope for active users
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for inactive users
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    // Scope for pending users
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for loginable users (active and not deleted)
    public function scopeLoginable($query)
    {
        return $query->where('status', 'active')->whereNull('deleted_at');
    }

    // Find user by email or mobile
    public function scopeFindByEmailOrMobile($query, $identifier)
    {
        $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL);
        
        if ($isEmail) {
            return $query->where('email', $identifier);
        } else {
            $mobile = preg_replace('/\D/', '', $identifier);
            return $query->where('mobile', 'like', '%' . $mobile . '%')
                        ->orWhere('mobile_number', 'like', '%' . $mobile . '%');
        }
    }
}
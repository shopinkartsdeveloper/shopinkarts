<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'web';

    /**
     * Fillable attributes for mass assignment
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'email_verified_at',
    ];

    /**
     * Hidden attributes for serialization
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes to native types
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Scope to find user by email or mobile
     */
    public function scopeFindByEmailOrMobile($query, $identifier)
    {
        // Check if identifier is email
        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            return $query->where('email', $identifier);
        }
        
        // Clean mobile number (remove non-digits)
        $mobile = preg_replace('/\D/', '', $identifier);
        
        // If it looks like a mobile number
        if (strlen($mobile) >= 10) {
            return $query->where('mobile', $mobile)
                        ->orWhere('mobile', 'like', '%' . $mobile . '%');
        }
        
        // If nothing matches, return empty result
        return $query->where('id', 0);
    }

    /**
     * Mutator for mobile number formatting
     */
    protected function mobile(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: function ($value) {
                // Remove all non-digit characters
                $mobile = preg_replace('/\D/', '', $value);
                
                // If starts with 91 and length is 12, remove 91
                if (strlen($mobile) == 12 && str_starts_with($mobile, '91')) {
                    $mobile = substr($mobile, 2);
                }
                
                // If starts with 0 and length is 11, remove 0
                if (strlen($mobile) == 11 && str_starts_with($mobile, '0')) {
                    $mobile = substr($mobile, 1);
                }
                
                // Ensure it's exactly 10 digits
                if (strlen($mobile) == 10) {
                    return $mobile;
                }
                
                // Return as is if not 10 digits (validation will catch it)
                return $mobile;
            },
        );
    }

    /**
     * Method to authenticate with mobile number
     */
    public static function findByMobile($mobile)
    {
        $cleanMobile = preg_replace('/\D/', '', $mobile);
        
        if (strlen($cleanMobile) == 10) {
            return static::where('mobile', $cleanMobile)->first();
        }
        
        return null;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is seller
     */
    public function isSeller()
    {
        return $this->hasRole('seller');
    }

    /**
     * Check if user is manufacturer - FIXED: Function name was missing
     */
    public function isManufacturer()
    {
        return $this->hasRole('manufacturer');
    }

    /**
     * Get user's role name
     */
    public function getRoleName()
    {
        return $this->roles->first()->name ?? 'user';
    }
}
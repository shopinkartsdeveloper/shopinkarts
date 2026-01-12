<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes trait

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'hsn_code',
        'category_id',
        'image',
        'status',
        'slug',
        'is_active'
    ];

    // Add dates for soft delete
    protected $dates = ['deleted_at'];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'manufacturers';

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile_number',
        'email',
        'whatsapp_number',
        'firm_name',
        'gst_number',
        'shop_name',
        'company_name',
        'status',
        'created_by'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
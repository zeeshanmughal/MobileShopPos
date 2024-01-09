<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'item_name', 'item_category', 'sub_category', 'manufacturer', 'device_model','quantity', 'warranty',
        'imei', 'price','condition', 'physical_location', 'sku', 'upc_code', 'short_description', 'image'
    ];
}

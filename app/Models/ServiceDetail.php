<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'repair_category', 'device', 'device_issue', 'imei_or_serial', 'repair_status', 'repair_time',
        'assigned_to', 'pickup_time', 'quantity', 'price', 'tax'
    ];
}

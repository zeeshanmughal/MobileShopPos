<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\DeviceIssue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = ['user_id','customer_id',
        'device_name', 'pickup_days','pickup_hours','mobile_pin', 'device_issue', 'imei_or_serial', 'repair_status','inventory_item_id',
        'assigned_to',  'quantity', 'price', 'tax', 'pickup_days','pickup_hours'
    ];

    public function ticket()
    {
        return $this->hasOne(Ticket::class,'service_detail_id','id');
    }

    public function deviceIssue()
    {
        return $this->belongsTo(DeviceIssue::class, 'device_issue', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
   
}

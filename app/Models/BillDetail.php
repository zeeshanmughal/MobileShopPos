<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillablae = ['user_id','customer_id','service_detail_id','ticket_id','price','quantity','tax','discount','total_paid','paid_by','bill_for','phone_id','total_price'];
}

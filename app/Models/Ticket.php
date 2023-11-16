<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\ServiceDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    public function serviceDetail()
    {
        return $this->belongsTo(ServiceDetail::class);
    }

    public function customer()
{
    return $this->belongsTo(Customer::class,'customer_id');
}
}

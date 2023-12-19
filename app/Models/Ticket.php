<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\ServiceDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['ticket_id','device_name','assigned_to','ticket_status','ticket_purpose','created_date','due_date','select_criteria','user_id','customer_id','service_detail_id'];

    public function serviceDetail()
    {
        return $this->belongsTo(ServiceDetail::class);
    }

    public function customer()
{
    return $this->belongsTo(Customer::class,'customer_id');
}
}

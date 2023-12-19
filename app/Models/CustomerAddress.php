<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAddress extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['customer_id','street_address', 'house_number', 'city', 'state', 'postcode', 'country','location'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}

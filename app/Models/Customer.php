<?php

namespace App\Models;

use App\Models\CustomerAddress;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerAdditionalInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['customer_group','organization', 'slug','uuid', 'first_name', 'last_name', 'email','country_code', 'phone','walk_in_customer',  'network', 'tax_class','driving_license','image'];

    public function address()
    {
        return $this->hasOne(CustomerAddress::class, 'customer_id', 'id');
    }

    public function additionalInformation()
    {
        return $this->hasOne(CustomerAdditionalInformation::class, 'customer_id', 'id');
    }
    public function serviceDetails(){
        return $this->hasMany(ServiceDetail::class,'customer_id','id');
    }
    public function tickets(){
        return $this->hasMany(Ticket::class,'customer_id','id');
    }
}

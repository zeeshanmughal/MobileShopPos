<?php

namespace App\Models;

use App\Models\CustomerAddress;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerAdditionalInformation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['customer_group', 'organization', 'first_name', 'last_name', 'email', 'phone', 'how_did_you_hear', 'network', 'tax_class'];

    public function address()
    {
        return $this->hasOne(CustomerAddress::class, 'customer_id', 'id');
    }

    public function additionalInformation()
    {
        return $this->hasOne(CustomerAdditionalInformation::class, 'customer_id', 'id');
    }
}

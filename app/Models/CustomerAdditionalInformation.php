<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAdditionalInformation extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id_type', 'id_number', 'driving_license', 'picture', 'contact_person_detail', 'contact_person_phone', 'relation', 'compliance_gdpr', 'sms_notification', 'email_notification'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}

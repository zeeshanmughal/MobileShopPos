<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAdditionalInformation extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'customer_id',
        'customer_id_type', 'id_number', 'driving_license', 'image', 'location','contact_person_name','contact_person_country_code', 'contact_person_phone', 'relation', 'compliance_gdpr', 'sms_notification', 'email_notification'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}

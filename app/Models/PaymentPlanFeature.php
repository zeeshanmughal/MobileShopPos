<?php

namespace App\Models;

use App\Models\PaymentPlan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentPlanFeature extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'payment_plan_id','feature_detail'];

    public function paymentPlan()
    {
        return $this->belongsTo(PaymentPlan::class, 'payment_plan_id', 'id');
    }
}

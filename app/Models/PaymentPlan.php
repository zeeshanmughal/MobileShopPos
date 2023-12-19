<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Models\PaymentPlanFeature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentPlan extends Model
{
    use HasFactory;
    
    public static function boot()
    {
        parent::boot();

        static::creating(function ($payment_plan) {
            $payment_plan->slug = Str::slug($payment_plan->name);
        });
    }
    
    protected $fillable = ['name','price','slug','interval','stripe_price_id'];
    public function features()
    {
        return $this->hasMany(PaymentPlanFeature::class, 'payment_plan_id', 'id');
    }
}

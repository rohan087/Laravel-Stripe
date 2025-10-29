<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'user_id',
        'provider', // 'stripe' or 'paypal'
        'provider_payment_method_id', // Stripe payment_method id or PayPal billing agreement id
        'type', // 'card', 'us_bank_account', 'paypal'
        'brand', // For cards
        'last4', // For cards/bank
        'exp_month', // For cards
        'exp_year', // For cards
        'bank_name', // For bank accounts
        'email', // For PayPal
        'is_default',
        'meta', // JSON for extra data
    ];

    protected $casts = [
        'meta' => 'array',
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

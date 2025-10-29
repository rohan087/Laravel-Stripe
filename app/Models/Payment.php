<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'paid_at',
        'recipient',
        'payment_method_id',
        'provider', // 'stripe' or 'paypal'
        'provider_payment_id', // Stripe payment_intent/charge id or PayPal transaction id
        'payment_method_type', // 'card', 'us_bank_account', 'paypal'
        'payment_method_details', // JSON for card/bank/paypal details
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'payment_method_details' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}

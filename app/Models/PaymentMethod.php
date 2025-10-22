<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stripe_payment_method_id',
        'type',
        'details',
        'is_default',
        'is_active',
        'save_for_future'
    ];

    protected $casts = [
        'details' => 'array',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'save_for_future' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isCard()
    {
        return $this->type === 'card';
    }

    public function isBankAccount()
    {
        return $this->type === 'bank_account';
    }

    public function getDisplayNameAttribute()
    {
        if ($this->isCard()) {
            return "Card •••• " . $this->details['last4'];
        } elseif ($this->isBankAccount()) {
            return "Bank Account •••• " . $this->details['last4'];
        }
        
        return 'Unknown Payment Method';
    }
}
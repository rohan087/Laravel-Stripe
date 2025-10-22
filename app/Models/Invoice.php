<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['customer_name', 'email', 'amount', 'stripe_invoice_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

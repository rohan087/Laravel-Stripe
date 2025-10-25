<?php
// config/stripe.php

return [
    'key' => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
    'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
    
    'surcharges' => [
        'credit_card' => env('CREDIT_CARD_SURCHARGE_PERCENTAGE', 4.5),
        'bank_account' => env('BANK_ACCOUNT_SURCHARGE_PERCENTAGE', 0),
    ],
    
    'currency' => 'usd',
    'country' => 'US',
];
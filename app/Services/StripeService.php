<?php

namespace App\Services;

use Stripe\StripeClient;

class StripeService
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    // ...existing methods...

    public function createSetupIntent($user, $paymentMethodType)
    {
        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
            return \Stripe\SetupIntent::create([
                'customer' => $user->stripe_customer_id,
                'payment_method_types' => [$paymentMethodType],
                'usage' => 'off_session',
            ]);
        } catch (\Exception $e) {
            \Log::error('Stripe SetupIntent Error: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getOrCreateStripeCustomer($user)
    {
        $stripe = new StripeClient(config('services.stripe.secret'));

        if (!$user->stripe_customer_id) {
            $customer = $stripe->customers->create([
                'email' => $user->email,
                'name' => $user->name,
                'metadata' => [
                    'user_id' => $user->id
                ]
            ]);
            $user->stripe_customer_id = $customer->id;
            $user->save();
            return $customer;
        } else {
            return $stripe->customers->retrieve($user->stripe_customer_id);
        }
    }
}
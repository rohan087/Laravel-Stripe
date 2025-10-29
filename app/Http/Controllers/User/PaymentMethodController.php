<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StripeService;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function handle(Request $request, StripeService $stripeService)
    {
        $user = Auth::user() ?? \App\Models\User::first();
        $setupIntentId = $request->input('setup_intent_id');
        $save = $request->boolean('save');
        $invoiceIds = $request->input('invoice_ids', []);
        $total = $request->input('total');
        $payAll = $request->boolean('pay_all');

        try {
            // Retrieve the SetupIntent and payment method from Stripe
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $setupIntent = $stripe->setupIntents->retrieve($setupIntentId);
            $paymentMethodId = $setupIntent->payment_method;
            $paymentMethod = $stripe->paymentMethods->retrieve($paymentMethodId);

            // Optionally save the payment method
            if ($save) {
                // Attach to customer if not already attached
                if (!in_array($user->stripe_customer_id, $paymentMethod->customer ? [$paymentMethod->customer] : [])) {
                    $stripe->paymentMethods->attach($paymentMethodId, [
                        'customer' => $user->stripe_customer_id,
                    ]);
                }
                // Save to local DB if not exists
                PaymentMethod::firstOrCreate([
                    'user_id' => $user->id,
                    'provider' => 'stripe',
                    'provider_payment_method_id' => $paymentMethodId,
                ], [
                    'type' => $paymentMethod->type,
                    'brand' => $paymentMethod->card->brand ?? null,
                    'last4' => $paymentMethod->card->last4 ?? $paymentMethod->us_bank_account->last4 ?? null,
                    'exp_month' => $paymentMethod->card->exp_month ?? null,
                    'exp_year' => $paymentMethod->card->exp_year ?? null,
                    'bank_name' => $paymentMethod->us_bank_account->bank_name ?? null,
                    'is_default' => false,
                    'meta' => json_encode($paymentMethod),
                ]);
            }

            // Always try to charge if not just saving
            if (!$save || $payAll) {
                $paymentIntent = $stripe->paymentIntents->create([
                    'amount' => intval($total * 100),
                    'currency' => 'usd',
                    'customer' => $user->stripe_customer_id,
                    'payment_method' => $paymentMethodId,
                    'off_session' => false,
                    'confirm' => true,
                ]);
                // Optionally, mark invoices as paid, create Payment record, etc.
                // ...your logic here...
                return response()->json(['success' => true]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Stripe PaymentMethod Handle Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

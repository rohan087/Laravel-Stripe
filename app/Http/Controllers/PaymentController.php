<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'description' => 'nullable|string|max:255'
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentMethod = PaymentMethod::where('id', $request->payment_method_id)
            ->where('user_id', Auth::id())
            ->where('is_active', true)
            ->firstOrFail();

        $baseAmount = $request->amount * 100; // Convert to cents
        $surcharge = 0;

        // Apply 4.5% surcharge for credit cards
        if ($paymentMethod->isCard()) {
            $surcharge = $baseAmount * 0.045;
        }

        $totalAmount = $baseAmount + $surcharge;

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $totalAmount,
                'currency' => 'usd',
                'payment_method' => $paymentMethod->stripe_payment_method_id,
                'customer' => Auth::user()->createOrGetStripeCustomer()->id,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => route('payment.success'),
                'metadata' => [
                    'user_id' => Auth::id(),
                    'payment_method_id' => $paymentMethod->id,
                    'description' => $request->description,
                    'surcharge_applied' => $paymentMethod->isCard() ? '4.5%' : '0%',
                    'base_amount' => $baseAmount,
                    'surcharge_amount' => $surcharge
                ]
            ]);

            if ($paymentIntent->status === 'succeeded') {
                // Payment successful
                return redirect()->route('payment.success')
                    ->with('success', 'Payment completed successfully!');
            } else {
                // Additional action required (3D Secure, etc.)
                return redirect($paymentIntent->next_action->use_stripe_sdk->stripe_js);
            }

        } catch (\Exception $e) {
            // Mark payment method as problematic
            $paymentMethod->update(['is_active' => false]);

            return redirect()->route('payment.methods')
                ->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function success()
    {
        return view('payment.success');
    }

    public function cancel()
    {
        return view('payment.cancel')->with('error', 'Payment was cancelled.');
    }

    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        switch ($event->type) {
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                // Handle successful payment
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                // Handle failed payment
                $this->handleFailedPayment($paymentIntent);
                break;

            case 'payment_method.automatically_updated':
                $paymentMethod = $event->data->object;
                // Handle payment method updates
                $this->handlePaymentMethodUpdate($paymentMethod);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    private function handleFailedPayment($paymentIntent)
    {
        // Update payment method status if payment fails
        if (isset($paymentIntent->metadata->payment_method_id)) {
            PaymentMethod::where('id', $paymentIntent->metadata->payment_method_id)
                ->update(['is_active' => false]);
        }
    }

    private function handlePaymentMethodUpdate($paymentMethod)
    {
        // Update local payment method record when Stripe updates it
        $localMethod = PaymentMethod::where('stripe_payment_method_id', $paymentMethod->id)->first();
        if ($localMethod) {
            $localMethod->update(['is_active' => true]);
        }
    }
}
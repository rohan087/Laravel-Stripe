<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\PaymentMethod as StripePaymentMethod;
use Stripe\Stripe;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = Auth::user()->activePaymentMethods()->get();
        
        return view('payment.methods', compact('paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_method_type' => 'required|in:card,bank_account',
            'save_for_future' => 'boolean',
            'stripe_payment_method_id' => 'required|string'
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Retrieve the payment method from Stripe
            $stripePaymentMethod = StripePaymentMethod::retrieve(
                $request->stripe_payment_method_id
            );

            // Check if payment method already exists
            $existingMethod = PaymentMethod::where('stripe_payment_method_id', $request->stripe_payment_method_id)
                ->where('user_id', Auth::id())
                ->first();

            if ($existingMethod) {
                return back()->with('error', 'This payment method is already saved.');
            }

            // Create local payment method record
            $paymentMethod = new PaymentMethod();
            $paymentMethod->user_id = Auth::id();
            $paymentMethod->stripe_payment_method_id = $request->stripe_payment_method_id;
            $paymentMethod->type = $request->payment_method_type;
            $paymentMethod->save_for_future = $request->boolean('save_for_future', false);
            $paymentMethod->is_active = true;

            // Store payment method details based on type
            if ($stripePaymentMethod->type === 'card') {
                $paymentMethod->details = [
                    'brand' => $stripePaymentMethod->card->brand,
                    'last4' => $stripePaymentMethod->card->last4,
                    'exp_month' => $stripePaymentMethod->card->exp_month,
                    'exp_year' => $stripePaymentMethod->card->exp_year,
                ];
            } elseif ($stripePaymentMethod->type === 'us_bank_account') {
                $paymentMethod->details = [
                    'bank_name' => $stripePaymentMethod->us_bank_account->bank_name,
                    'last4' => $stripePaymentMethod->us_bank_account->last4,
                    'account_type' => $stripePaymentMethod->us_bank_account->account_type,
                ];
            }

            $paymentMethod->save();

            return redirect()->route('payment.methods')
                ->with('success', 'Payment method added successfully!');

        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add payment method: ' . $e->getMessage());
        }
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->user_id !== Auth::id()) {
            abort(403);
        }

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            
            // Detach payment method from Stripe customer
            $stripePaymentMethod = StripePaymentMethod::retrieve($paymentMethod->stripe_payment_method_id);
            $stripePaymentMethod->detach();

            $paymentMethod->delete();

            return back()->with('success', 'Payment method deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete payment method: ' . $e->getMessage());
        }
    }

    public function setDefault(PaymentMethod $paymentMethod)
    {
        if ($paymentMethod->user_id !== Auth::id()) {
            abort(403);
        }

        // Remove default from all other payment methods
        Auth::user()->paymentMethods()->update(['is_default' => false]);

        // Set this as default
        $paymentMethod->update(['is_default' => true]);

        return back()->with('success', 'Default payment method updated!');
    }
}
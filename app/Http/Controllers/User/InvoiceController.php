<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\PaymentMethod;

class InvoiceController extends Controller
{
    public function index()
    {
        $user = Auth::user() ?? \App\Models\User::first();
        $invoices = Invoice::where('user_id', $user->id)->get();
        return view('user.invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $user = Auth::user() ?? \App\Models\User::first();
        $invoice = Invoice::where('user_id', $user->id)->findOrFail($id);
        return view('user.invoices.show', compact('invoice'));
    }

    public function makePayment($id)
    {
        $user = auth()->user() ?? \App\Models\User::first();
        $invoice = \App\Models\Invoice::where('user_id', $user->id)->findOrFail($id);
        return view('user.invoices.pay', compact('invoice'));
    }

    public function pay($id = null)
    {
        $user = auth()->user() ?? \App\Models\User::first();
        $surchargePercent = (float) Setting::get('card_surcharge_percent', 4.5);

        if ($id && strtolower($id) !== 'all') {
            // Single invoice payment
            $invoice = \App\Models\Invoice::where('user_id', $user->id)->findOrFail($id);
            $invoices = collect([$invoice]);
            $payAll = false;
        } else {
            // Pay all pending invoices
            $invoices = \App\Models\Invoice::where('user_id', $user->id)
                ->where('status', '!=', 'Paid')
                ->get();
            $payAll = true;
        }
        $total = $invoices->sum('amount');

        // Fetch saved payment methods for the user
        $savedPaymentMethods = PaymentMethod::where('user_id', $user->id)->get()->map(function ($method) {
            return [
                'id' => $method->id,
                'type' => $method->type,
                'brand' => $method->brand,
                'last4' => $method->last4,
                'bank_name' => $method->bank_name,
            ];
        });

        // Pass Stripe public key to the view
        $stripePublicKey = config('services.stripe.key');

        return view('user.invoices.pay', compact('invoices', 'total', 'surchargePercent', 'payAll', 'savedPaymentMethods', 'stripePublicKey'));
    }
}

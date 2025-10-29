<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StripeService;

class StripeSetupIntentController extends Controller
{
    public function create(Request $request, StripeService $stripeService)
    {
        $user = Auth::user() ?? \App\Models\User::first();
        $paymentMethodType = $request->input('payment_method_type', 'card');
        $setupIntent = $stripeService->createSetupIntent($user, $paymentMethodType);
        return response()->json(['clientSecret' => $setupIntent->client_secret]);
    }
}

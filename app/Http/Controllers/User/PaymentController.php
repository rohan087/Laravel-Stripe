<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user() ?? \App\Models\User::first();
        $payments = Payment::where('user_id', $user->id)->get();
        return view('user.payments.index', compact('payments'));
    }

    public function show($id)
    {
        $user = Auth::user() ?? \App\Models\User::first();
        $payment = Payment::where('user_id', $user->id)->findOrFail($id);
        return view('user.payments.show', compact('payment'));
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        return view('user.payments.index'); // Ensure this view exists
    }

    /**
     * Display the specified payment.
     */
    public function show($id)
    {
        return view('user.payments.show', compact('id')); // Ensure this view exists
    }
}

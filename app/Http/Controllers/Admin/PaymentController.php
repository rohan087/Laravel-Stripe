<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     * Display a listing of payments.
     */
    public function index()
    {
        return view('admin.payments.index'); // Ensure this view exists
    }

    /**
     * Display the specified payment.
     */
    public function show($id)
    {
        return view('admin.payments.show', compact('id')); // Ensure this view exists
    }
}

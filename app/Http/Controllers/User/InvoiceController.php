<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices.
     */
    public function index()
    {
        return view('user.invoices.index'); // Ensure this view exists
    }

    /**
     * Display the specified invoice.
     */
    public function show($id)
    {
        return view('user.invoices.show', compact('id')); // Ensure this view exists
    }
}

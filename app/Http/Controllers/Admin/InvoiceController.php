<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    /**
     * Display a listing of invoices.
     */
    public function index()
    {
        return view('admin.invoices.index'); // Ensure this view exists
    }

    /**
     * Display the specified invoice.
     */
    public function show($id)
    {
        return view('admin.invoices.show', compact('id')); // Ensure this view exists
    }
}

@extends('layouts.app')

@section('content')
<h1>Invoices</h1>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Amount</th>
            <th>Stripe Invoice ID</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
        <tr>
            <td>{{ $invoice->customer_name }}</td>
            <td>{{ $invoice->email }}</td>
            <td>${{ $invoice->amount }}</td>
            <td>{{ $invoice->stripe_invoice_id ?? 'Not created' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
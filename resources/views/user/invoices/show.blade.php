@extends('layouts.app')

@section('title', 'Invoice Details - StripePay')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.user-topbar', ['active' => 'invoices'])
    <div class="container mt-5">
        <h1 class="text-center">Invoice Details</h1>
        <div class="mt-4">
            <p><strong>Invoice ID:</strong> {{ $invoice->id }}</p>
            <p><strong>Amount:</strong> ${{ $invoice->amount }}</p>
            <p><strong>Date:</strong> {{ $invoice->date }}</p>
            <p><strong>Description:</strong> {{ $invoice->description }}</p>
        </div>
        <a href="{{ url('/user/invoices') }}" class="btn btn-secondary">Back to Invoices</a>
    </div>
</div>
@endsection

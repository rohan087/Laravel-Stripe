@extends('layouts.app')

@section('title', 'Payment Details - StripePay')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.user-topbar', ['active' => 'payments'])
    <div class="container mt-5">
        <h1 class="text-center">Payment Details</h1>
        <div class="mt-4">
            <p><strong>Payment ID:</strong> {{ $payment->id }}</p>
            <p><strong>Amount:</strong> ${{ $payment->amount }}</p>
            <p><strong>Date:</strong> {{ $payment->date }}</p>
            <p><strong>Description:</strong> {{ $payment->description }}</p>
        </div>
        <a href="{{ url('/user/payments') }}" class="btn btn-secondary">Back to Payments</a>
    </div>
</div>
@endsection

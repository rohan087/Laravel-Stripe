@extends('layouts.app')

@section('title', 'Make Payment - StripePay')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.user-topbar', ['active' => 'invoices'])

    <div class="max-w-5xl mx-auto mt-16 flex flex-col md:flex-row gap-8">
        <!-- Left Card: Invoice Info + Preferred Methods -->
        <div class="flex-1 bg-white rounded-2xl shadow p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                {{ $payAll ? 'Pending Invoices' : 'Invoice Details' }}
            </h2>
            <div class="space-y-3 mb-8">
                @if($payAll)
                    @forelse($invoices as $invoice)
                        <div class="flex justify-between items-center border-b border-gray-100 pb-3">
                            <div>
                                <div class="font-semibold text-gray-900">{{ $invoice->number }}</div>
                                <div class="text-xs text-gray-500">{{ $invoice->description ?? '-' }}</div>
                                <div class="text-xs text-gray-400">Due: {{ $invoice->due_date }}</div>
                            </div>
                            <div class="font-semibold text-blue-700">${{ number_format($invoice->amount, 2) }}</div>
                        </div>
                    @empty
                        <div class="text-gray-500">No pending invoices.</div>
                    @endforelse
                @else
                    @php $invoice = $invoices->first(); @endphp
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Invoice Number:</span>
                        <span class="text-gray-900">{{ $invoice->number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Amount Due:</span>
                        <span class="text-gray-900">${{ number_format($invoice->amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Due Date:</span>
                        <span class="text-gray-900">{{ $invoice->due_date }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Status:</span>
                        <span class="text-gray-900">{{ $invoice->status }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium text-gray-700">Description:</span>
                        <span class="text-gray-900">{{ $invoice->description ?? '-' }}</span>
                    </div>
                @endif
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-6">Preferred Payment Methods</h2>
            <form id="payment-method-form">
                <div class="space-y-4">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="radio" name="payment_method" value="card" class="form-radio text-blue-600" checked onchange="updateSurcharge()">
                        <span class="flex items-center">
                            <i class="fab fa-cc-visa text-blue-700 text-xl mr-2"></i>
                            <span class="text-gray-800">Visa ending in 4242</span>
                        </span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="radio" name="payment_method" value="card" class="form-radio text-blue-600" onchange="updateSurcharge()">
                        <span class="flex items-center">
                            <i class="fab fa-cc-mastercard text-red-600 text-xl mr-2"></i>
                            <span class="text-gray-800">Mastercard ending in 1234</span>
                        </span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="radio" name="payment_method" value="card" class="form-radio text-blue-600" onchange="updateSurcharge()">
                        <span class="flex items-center">
                            <i class="fab fa-cc-amex text-indigo-600 text-xl mr-2"></i>
                            <span class="text-gray-800">Amex ending in 3005</span>
                        </span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="radio" name="payment_method" value="bank" class="form-radio text-blue-600" onchange="updateSurcharge()">
                        <span class="flex items-center">
                            <i class="fas fa-university text-gray-600 text-xl mr-2"></i>
                            <span class="text-gray-800">Bank Transfer</span>
                        </span>
                    </label>
                    <button type="button" class="mt-4 w-full border border-blue-600 text-blue-600 rounded-lg py-2 font-medium hover:bg-blue-50 transition">
                        + Add New Payment Method
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Card: Payment Summary -->
        <div class="flex-1 bg-white rounded-2xl shadow p-8 h-fit">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Payment Summary</h2>
            <div class="space-y-3 mb-8">
                <div class="flex justify-between">
                    <span class="text-gray-700">Subtotal:</span>
                    <span class="text-gray-900" id="subtotal-amount">${{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between" id="surcharge-row">
                    <span class="text-gray-700">
                        Card Surcharge (<span id="surcharge-percent">{{ $surchargePercent }}</span>%):
                    </span>
                    <span class="text-gray-900" id="surcharge-amount">
                        ${{ number_format($total * $surchargePercent / 100, 2) }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-700">Tax:</span>
                    <span class="text-gray-900">$0.00</span>
                </div>
                <div class="flex justify-between font-bold text-lg">
                    <span>Total:</span>
                    <span id="total-amount">
                        ${{ number_format($total + ($total * $surchargePercent / 100), 2) }}
                    </span>
                </div>
            </div>
            <form action="#" method="POST">
                @csrf
                <button type="submit" id="pay-btn" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Pay ${{ number_format($total + ($total * $surchargePercent / 100), 2) }}
                </button>
            </form>
            <a href="{{ url('/user/invoices') }}" class="block text-center text-blue-500 hover:underline mt-6">Back to Invoices</a>
        </div>
    </div>
</div>
<script>
    function updateSurcharge() {
        const amount = {{ $total }};
        const surchargePercent = parseFloat(document.getElementById('surcharge-percent').innerText);
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        const surchargeRow = document.getElementById('surcharge-row');
        let surcharge = 0;
        let total = amount;

        if (method === 'card') {
            surcharge = amount * surchargePercent / 100;
            surchargeRow.style.display = '';
        } else {
            surcharge = 0;
            surchargeRow.style.display = 'none';
        }
        total = amount + surcharge;

        document.getElementById('surcharge-amount').innerText = '$' + surcharge.toFixed(2);
        document.getElementById('total-amount').innerText = '$' + total.toFixed(2);
        document.getElementById('pay-btn').innerText = 'Pay $' + total.toFixed(2);
    }
    document.addEventListener('DOMContentLoaded', updateSurcharge);
</script>
@endsection

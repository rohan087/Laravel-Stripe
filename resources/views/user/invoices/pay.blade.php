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
                <div class="space-y-4" id="saved-payment-methods-list">
                    @foreach($savedPaymentMethods as $method)
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="radio" name="payment_method_id" value="{{ $method['id'] }}" class="form-radio text-blue-600" {{ $loop->first ? 'checked' : '' }} onchange="updateSurcharge()">
                            <span class="flex items-center">
                                @if($method['type'] === 'card')
                                    <i class="fab fa-cc-{{ strtolower($method['brand']) }} text-blue-700 text-xl mr-2"></i>
                                    <span class="text-gray-800">{{ ucfirst($method['brand']) }} ending in {{ $method['last4'] }}</span>
                                @elseif($method['type'] === 'us_bank_account')
                                    <i class="fas fa-university text-gray-600 text-xl mr-2"></i>
                                    <span class="text-gray-800">{{ $method['bank_name'] }} ending in {{ $method['last4'] }}</span>
                                @endif
                            </span>
                        </label>
                    @endforeach
                </div>
                <div class="flex gap-4 mt-4">
                    <button type="button" id="show-add-card" class="flex items-center justify-center w-1/2 bg-blue-600 text-white rounded-lg py-2 font-medium hover:bg-blue-700 transition">
                        <i class="fas fa-credit-card text-xl mr-2"></i>
                        Add Card Payment
                    </button>
                    <button type="button" id="show-add-bank" class="flex items-center justify-center w-1/2 bg-green-600 text-white rounded-lg py-2 font-medium hover:bg-green-700 transition">
                        <i class="fas fa-university text-xl mr-2"></i>
                        Add Bank Account
                    </button>
                </div>
            </form>

            <!-- Add Card Payment Modal/Dialog -->
            <div id="add-card-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                    <button type="button" id="close-add-card-modal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                    <h3 class="text-lg font-medium mb-4">Add Card Payment</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Card Details</label>
                        <div id="card-payment-element" class="bg-gray-50 p-4 border border-gray-200 rounded-lg mb-4"></div>
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="save-card-method" name="save_card_method" class="form-checkbox text-blue-600" checked>
                            <span class="text-gray-800 text-sm">Save this card for future purchases</span>
                        </label>
                    </div>
                    <div class="text-right">
                        <button type="button" id="add-card-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition">
                            Add Card
                        </button>
                    </div>
                </div>
            </div>

            <!-- Add Bank Account Modal/Dialog -->
            <div id="add-bank-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 hidden">
                <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
                    <button type="button" id="close-add-bank-modal" class="absolute top-2 right-2 text-gray-400 hover:text-gray-700 text-2xl">&times;</button>
                    <h3 class="text-lg font-medium mb-4">Add Bank Account</h3>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bank Account Details</label>
                        <div id="bank-payment-element" class="bg-gray-50 p-4 border border-gray-200 rounded-lg mb-4"></div>
                    </div>
                    <div class="mb-4">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="save-bank-method" name="save_bank_method" class="form-checkbox text-blue-600" checked>
                            <span class="text-gray-800 text-sm">Save this bank account for future purchases</span>
                        </label>
                    </div>
                    <div class="text-right">
                        <button type="button" id="add-bank-btn" class="bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition">
                            Add Bank Account
                        </button>
                    </div>
                </div>
            </div>
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
<script src="https://js.stripe.com/v3/"></script>
<script>
    function updateSurcharge() {
        const amount = {{ $total }};
        const surchargePercent = parseFloat(document.getElementById('surcharge-percent').innerText);
        // Fix: use correct name for radio buttons and handle null
        const selected = document.querySelector('input[name="payment_method_id"]:checked');
        const surchargeRow = document.getElementById('surcharge-row');
        let surcharge = 0;
        let total = amount;

        // Default to card if no method is selected (shouldn't happen, but safe)
        let methodType = 'card';
        if (selected) {
            // Find the type from the DOM (data attribute or fallback)
            const label = selected.closest('label');
            if (label && label.innerHTML.includes('fa-university')) {
                methodType = 'bank';
            } else {
                methodType = 'card';
            }
        }

        if (methodType === 'card') {
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

    document.addEventListener('DOMContentLoaded', function() {
        updateSurcharge();

        // Show add card payment method dialog
        document.getElementById('show-add-card').addEventListener('click', function() {
            document.getElementById('add-card-modal').classList.remove('hidden');
            initializeStripeElement('card');
        });

        // Show add bank account payment method dialog
        document.getElementById('show-add-bank').addEventListener('click', function() {
            document.getElementById('add-bank-modal').classList.remove('hidden');
            initializeStripeElement('us_bank_account');
        });

        // Hide add card payment method dialog
        document.getElementById('close-add-card-modal').addEventListener('click', function() {
            document.getElementById('add-card-modal').classList.add('hidden');
        });

        // Hide add bank account dialog
        document.getElementById('close-add-bank-modal').addEventListener('click', function() {
            document.getElementById('add-bank-modal').classList.add('hidden');
        });

        // Hide dialogs on background click
        document.getElementById('add-card-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
        document.getElementById('add-bank-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
            }
        });
    });

    let stripe = Stripe('{{ $stripePublicKey }}');
    let elements, paymentElement, setupIntentClientSecret = null;

    function initializeStripeElement(type) {
        // Determine which element to mount into
        let mountId = type === 'card' ? '#card-payment-element' : '#bank-payment-element';

        fetch('{{ route('stripe.createSetupIntent') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ payment_method_type: type })
        })
        .then(res => res.json())
        .then(data => {
            setupIntentClientSecret = data.clientSecret;
            elements = stripe.elements({clientSecret: setupIntentClientSecret});
            if (paymentElement) paymentElement.unmount();

            if (type === 'card') {
                paymentElement = elements.create('card', {
                    style: {
                        base: {
                            fontSize: '16px',
                            color: '#32325d',
                        }
                    }
                });
                paymentElement.mount(mountId);
                // Attach the correct handler
                document.getElementById('add-card-btn').onclick = function(e) {
                    e.preventDefault();
                    handleAddPaymentMethod(elements);
                };
            } else if (type === 'us_bank_account') {
                paymentElement = elements.create('payment', {
                    paymentMethodOrder: ['us_bank_account']
                });
                paymentElement.mount(mountId);
                // Attach the correct handler
                document.getElementById('add-bank-btn').onclick = function(e) {
                    e.preventDefault();
                    handleAddPaymentMethod(elements);
                };
            }
        });
    }

    function handleAddPaymentMethod(elementsInstance) {
        // Determine if saving or charging immediately
        let isCard = !!document.getElementById('add-card-btn') && document.getElementById('add-card-btn').offsetParent !== null;
        let saveCheckbox = isCard
            ? document.getElementById('save-card-method')
            : document.getElementById('save-bank-method');
        let shouldSave = saveCheckbox && saveCheckbox.checked;

        stripe.confirmSetup({
            elements: elementsInstance,
            confirmParams: {
                return_url: window.location.href
            },
            redirect: 'if_required'
        }).then(function(result) {
            if (result.error) {
                alert(result.error.message);
            } else if (result.setupIntent && result.setupIntent.status === 'succeeded') {
                // Save or charge via AJAX
                fetch('{{ route('user.payment-method.handle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        setup_intent_id: result.setupIntent.id,
                        save: shouldSave,
                        invoice_ids: @json($invoices->pluck('id')),
                        total: {{ $total }},
                        pay_all: {{ $payAll ? 'true' : 'false' }}
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        alert(data.error || 'An error occurred.');
                    }
                });
            }
        });
    }
</script>
@endsection

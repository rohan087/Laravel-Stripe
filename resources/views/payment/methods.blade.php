@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Payment Methods</h4>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Add New Payment Method Buttons -->
                    <div class="mb-4">
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#cardModal">
                            Pay by Card
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#bankModal">
                            Pay by US Bank Account
                        </button>
                    </div>

                    <!-- Saved Payment Methods -->
                    <h5>Saved Payment Methods</h5>
                    
                    @if($paymentMethods->count() > 0)
                        <div class="list-group">
                            @foreach($paymentMethods as $method)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $method->display_name }}</strong>
                                        @if($method->is_default)
                                            <span class="badge bg-primary ms-2">Default</span>
                                        @endif
                                        @if(!$method->is_active)
                                            <span class="badge bg-danger ms-2">Inactive</span>
                                        @endif
                                        <br>
                                        <small class="text-muted">
                                            @if($method->isCard())
                                                {{ $method->details['brand'] }} • Expires {{ $method->details['exp_month'] }}/{{ $method->details['exp_year'] }}
                                                <span class="text-warning">(4.5% surcharge applies)</span>
                                            @else
                                                {{ $method->details['bank_name'] }} • {{ ucfirst($method->details['account_type']) }}
                                                <span class="text-success">(No surcharge)</span>
                                            @endif
                                        </small>
                                    </div>
                                    <div>
                                        @if($method->is_active)
                                            <form action="{{ route('payment.methods.default', $method) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-primary" {{ $method->is_default ? 'disabled' : '' }}>
                                                    Set Default
                                                </button>
                                            </form>
                                        @endif
                                        <form action="{{ route('payment.methods.destroy', $method) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-info">
                            No payment methods saved yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Card Payment Modal -->
<div class="modal fade" id="cardModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Credit/Debit Card</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="card-element">
                    <!-- Stripe Card Element will be inserted here -->
                </div>
                <div id="card-errors" class="text-danger mt-2"></div>
                
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="save-card" name="save_for_future" checked>
                    <label class="form-check-label" for="save-card">Save this card for future payments</label>
                </div>
                
                <div class="alert alert-warning mt-3">
                    <small>A 4.5% surcharge will be applied to card payments.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submit-card">Add Card</button>
            </div>
        </div>
    </div>
</div>

<!-- Bank Account Modal -->
<div class="modal fade" id="bankModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add US Bank Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="bank-element">
                    <!-- Stripe Bank Account Element will be inserted here -->
                </div>
                <div id="bank-errors" class="text-danger mt-2"></div>
                
                <div class="form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="save-bank" name="save_for_future" checked>
                    <label class="form-check-label" for="save-bank">Save this bank account for future payments</label>
                </div>
                
                <div class="alert alert-success mt-3">
                    <small>No surcharge for bank account payments.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submit-bank">Add Bank Account</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ config('services.stripe.key') }}');
    
    // Card Payment Setup
    const cardElements = {
        card: stripe.elements().create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
        }),
        bankAccount: stripe.elements().create('bankAccount', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
            // US only
            supportedCountries: ['US'],
            // You can optionally show the country dropdown
            country: 'US',
        })
    };

    cardElements.card.mount('#card-element');
    cardElements.bankAccount.mount('#bank-element');

    // Handle card payment method
    document.getElementById('submit-card').addEventListener('click', async () => {
        const {paymentMethod, error} = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElements.card,
        });

        if (error) {
            document.getElementById('card-errors').textContent = error.message;
        } else {
            await addPaymentMethod(paymentMethod.id, 'card');
        }
    });

    // Handle bank account payment method
    document.getElementById('submit-bank').addEventListener('click', async () => {
        const {paymentMethod, error} = await stripe.createPaymentMethod({
            type: 'us_bank_account',
            us_bank_account: cardElements.bankAccount,
            billing_details: {
                name: '{{ Auth::user()->name }}',
            },
        });

        if (error) {
            document.getElementById('bank-errors').textContent = error.message;
        } else {
            await addPaymentMethod(paymentMethod.id, 'bank_account');
        }
    });

    async function addPaymentMethod(paymentMethodId, type) {
        const saveForFuture = document.getElementById(`save-${type}`).checked;
        
        try {
            const response = await fetch('{{ route("payment.methods.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    stripe_payment_method_id: paymentMethodId,
                    payment_method_type: type,
                    save_for_future: saveForFuture
                })
            });

            const result = await response.json();

            if (response.ok) {
                window.location.reload();
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            alert('Error adding payment method: ' + error.message);
        }
    }
</script>
@endpush
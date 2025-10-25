@extends('layouts.app')

@section('title', 'Invoices - StripePay')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.user-topbar', ['active' => 'invoices'])    

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-display font-semibold text-gray-900 mb-2">Invoices</h1>
                <p class="text-gray-600">Manage and pay your outstanding invoices</p>
            </div>
            @php
                $unpaidTotal = $invoices->where('status', '!=', 'Paid')->sum('amount');
                $unpaidCount = $invoices->where('status', '!=', 'Paid')->count();
            @endphp
            @if($unpaidCount > 0)
                <a href="{{ route('user.invoices.pay', ['id' => 'all']) }}"
                   class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition-colors duration-200 mt-4 md:mt-0">
                    <i class="fas fa-credit-card mr-2"></i>
                    Pay All
                    <span class="ml-3 bg-blue-700 px-3 py-1 rounded-full text-sm font-bold">${{ number_format($unpaidTotal, 2) }}</span>
                </a>
            @endif
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Total Invoices</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">12</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-file-invoice text-blue-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pending</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">3</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Paid</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">8</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Overdue</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">1</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="relative">
                        <select class="appearance-none bg-gray-50 border border-gray-200 rounded-xl pl-4 pr-10 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>All Status</option>
                            <option>Pending</option>
                            <option>Paid</option>
                            <option>Overdue</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <input type="text" placeholder="Search invoices..." class="bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full md:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <button class="bg-gray-900 text-white px-6 py-3 rounded-xl font-medium hover:bg-gray-800 transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-download"></i>
                    <span>Export</span>
                </button>
            </div>
        </div>

        <!-- Invoices Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($invoices as $invoice)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $invoice->number }}</div>
                                    <div class="text-sm text-gray-500">{{ $invoice->description ?? '' }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $invoice->client ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">${{ number_format($invoice->amount, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($invoice->status === 'Paid')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Paid
                                    </span>
                                @elseif($invoice->status === 'Pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-triangle mr-1"></i>
                                        Overdue
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ url('/user/invoices/'.$invoice->id) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 flex items-center space-x-1">
                                        <i class="fas fa-eye"></i>
                                        <span>View</span>
                                    </a>
                                    <span class="text-gray-400">|</span>
                                    @if(strtolower($invoice->status) === 'paid')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Paid
                                        </span>
                                    @else
                                        <a href="{{ route('user.invoices.pay', ['id' => $invoice->id]) }}"
                                           class="text-blue-600 hover:text-blue-900 transition-colors duration-200 flex items-center space-x-1">
                                            <i class="fas fa-credit-card"></i>
                                            <span>Pay</span>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">12</span> results
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 rounded-lg bg-blue-600 text-white border border-blue-600">1</button>
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">2</button>
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">3</button>
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Invoice Modal -->
<div id="viewInvoiceModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-900">Invoice Details</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Invoice content would go here -->
            <div class="text-center py-8">
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-invoice text-blue-600 text-2xl"></i>
                </div>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Invoice Preview</h4>
                <p class="text-gray-600">Detailed invoice view would appear here with all line items, totals, and client information.</p>
            </div>
        </div>
        
        <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
            <div class="flex justify-end space-x-3">
                <button onclick="closeModal()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200">
                    Close
                </button>
                <button class="px-6 py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-print"></i>
                    <span>Print</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
@foreach ($invoices as $invoice)
<div id="paymentModal-{{ $invoice->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-md w-full">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-900">Process Payment</h3>
                <button onclick="closePaymentModal({{ $invoice->id }})" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="text-center mb-6">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-credit-card text-green-600 text-2xl"></i>
                </div>
                <h4 class="text-lg font-medium text-gray-900 mb-2">Confirm Payment</h4>
                <p class="text-gray-600">You are about to process a payment for <span class="font-semibold">${{ number_format($invoice->amount, 2) }}</span></p>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                    <select class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option>Credit Card ending in 4242</option>
                        <option>Bank Transfer</option>
                        <option>PayPal</option>
                    </select>
                </div>
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-yellow-400"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Test Mode</h3>
                            <div class="mt-1 text-sm text-yellow-700">
                                <p>This is a demo payment. No real transaction will occur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
            <div class="flex justify-end space-x-3">
                <button onclick="closePaymentModal({{ $invoice->id }})" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200">
                    Cancel
                </button>
                <a href="{{ url('/user/invoices/'.$invoice->id.'/pay') }}"
                   class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition block text-center">
                    Proceed to Payment
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function viewInvoice() {
        document.getElementById('viewInvoiceModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('viewInvoiceModal').classList.add('hidden');
    }

    function makePayment() {
        document.getElementById('paymentModal').classList.remove('hidden');
    }

    function closePaymentModal(invoiceId) {
        document.getElementById('paymentModal-' + invoiceId).classList.add('hidden');
    }

    // Add event listeners to view buttons
    document.addEventListener('DOMContentLoaded', function() {
        const viewButtons = document.querySelectorAll('button:has(.fa-eye)');
        viewButtons.forEach(button => {
            button.addEventListener('click', viewInvoice);
        });

        const payButtons = document.querySelectorAll('button:has(.fa-credit-card)');
        payButtons.forEach(button => {
            // Only add event listener if not disabled
            if (!button.classList.contains('cursor-not-allowed')) {
                button.addEventListener('click', makePayment);
            }
        });
    });
</script>
@endsection
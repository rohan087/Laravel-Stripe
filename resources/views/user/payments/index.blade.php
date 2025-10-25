@extends('layouts.app')

@section('title', 'Payments - StripePay')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.user-topbar', ['active' => 'payments'])

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-display font-semibold text-gray-900 mb-2">Payment History</h1>
            <p class="text-gray-600">View and manage all your payment transactions</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Total Payments</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">24</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-receipt text-blue-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">This Month</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">$8,450</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-green-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Successful</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">22</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Failed</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">2</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-red-50 flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600 text-lg"></i>
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
                            <option>Completed</option>
                            <option>Pending</option>
                            <option>Failed</option>
                            <option>Refunded</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <select class="appearance-none bg-gray-50 border border-gray-200 rounded-xl pl-4 pr-10 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option>All Methods</option>
                            <option>Credit Card</option>
                            <option>Bank Transfer</option>
                            <option>PayPal</option>
                            <option>Apple Pay</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <i class="fas fa-chevron-down"></i>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <input type="text" placeholder="Search payments..." class="bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full md:w-64">
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

        <!-- Payments Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Payment 1 -->
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">pay_1Jk8d72eZvKYlo2C</div>
                                <div class="text-sm text-gray-500">INV-001</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Jan 15, 2024</div>
                                <div class="text-sm text-gray-500">10:30 AM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                        <span class="text-blue-600 text-sm font-medium">A</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Acme Inc.</div>
                                        <div class="text-sm text-gray-500">contact@acme.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">$2,500.00</div>
                                <div class="text-sm text-gray-500">USD</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center mr-2">
                                        <i class="fab fa-cc-visa text-purple-600"></i>
                                    </div>
                                    <span class="text-sm text-gray-900">Visa •••• 4242</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Completed
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewPaymentDetails('pay_1Jk8d72eZvKYlo2C')" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 flex items-center space-x-1">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Payment 2 -->
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">pay_2Lm9e83fAwLXmp3D</div>
                                <div class="text-sm text-gray-500">INV-002</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Feb 28, 2024</div>
                                <div class="text-sm text-gray-500">02:15 PM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <span class="text-green-600 text-sm font-medium">B</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Beta Corp</div>
                                        <div class="text-sm text-gray-500">billing@beta.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">$1,800.00</div>
                                <div class="text-sm text-gray-500">USD</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-2">
                                        <i class="fas fa-university text-blue-600"></i>
                                    </div>
                                    <span class="text-sm text-gray-900">Bank Transfer</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-clock mr-1"></i>
                                    Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewPaymentDetails('pay_2Lm9e83fAwLXmp3D')" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 flex items-center space-x-1">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Payment 3 -->
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">pay_3Mn0f94gBxMYnq4E</div>
                                <div class="text-sm text-gray-500">INV-003</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Mar 10, 2024</div>
                                <div class="text-sm text-gray-500">09:45 AM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                        <span class="text-purple-600 text-sm font-medium">G</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Gamma LLC</div>
                                        <div class="text-sm text-gray-500">payments@gamma.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">$3,200.00</div>
                                <div class="text-sm text-gray-500">USD</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center mr-2">
                                        <i class="fab fa-cc-mastercard text-yellow-600"></i>
                                    </div>
                                    <span class="text-sm text-gray-900">Mastercard •••• 8888</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Completed
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewPaymentDetails('pay_3Mn0f94gBxMYnq4E')" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 flex items-center space-x-1">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Payment 4 -->
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">pay_4No1g05hCyNZor5F</div>
                                <div class="text-sm text-gray-500">INV-004</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Jan 5, 2024</div>
                                <div class="text-sm text-gray-500">04:20 PM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                        <span class="text-red-600 text-sm font-medium">D</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Delta Co.</div>
                                        <div class="text-sm text-gray-500">finance@delta.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">$950.00</div>
                                <div class="text-sm text-gray-500">USD</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mr-2">
                                        <i class="fab fa-paypal text-blue-600"></i>
                                    </div>
                                    <span class="text-sm text-gray-900">PayPal</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Failed
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewPaymentDetails('pay_4No1g05hCyNZor5F')" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 flex items-center space-x-1">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </button>
                            </td>
                        </tr>

                        <!-- Payment 5 -->
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">pay_5Op2h16iDzOZps6G</div>
                                <div class="text-sm text-gray-500">INV-005</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">Apr 15, 2024</div>
                                <div class="text-sm text-gray-500">11:10 AM</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                        <span class="text-indigo-600 text-sm font-medium">E</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">Epsilon Ltd</div>
                                        <div class="text-sm text-gray-500">accounts@epsilon.com</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">$1,250.00</div>
                                <div class="text-sm text-gray-500">USD</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg bg-black flex items-center justify-center mr-2">
                                        <i class="fab fa-apple-pay text-white"></i>
                                    </div>
                                    <span class="text-sm text-gray-900">Apple Pay</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Completed
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="viewPaymentDetails('pay_5Op2h16iDzOZps6G')" class="text-blue-600 hover:text-blue-900 transition-colors duration-200 flex items-center space-x-1">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">24</span> results
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 rounded-lg bg-blue-600 text-white border border-blue-600">1</button>
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">2</button>
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">3</button>
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">4</button>
                        <button class="px-3 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-50 transition-colors duration-200">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Details Modal -->
<div id="paymentDetailsModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-semibold text-gray-900">Payment Details</h3>
                <button onclick="closePaymentDetails()" class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Payment Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h4 class="text-lg font-semibold text-gray-900" id="paymentId">pay_1Jk8d72eZvKYlo2C</h4>
                    <p class="text-gray-600" id="paymentDate">January 15, 2024 at 10:30 AM</p>
                </div>
                <span id="paymentStatus" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    <i class="fas fa-check-circle mr-1"></i>
                    Completed
                </span>
            </div>

            <!-- Payment Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-50 rounded-xl p-4">
                    <h5 class="font-medium text-gray-900 mb-3">Customer Information</h5>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Name</span>
                            <span class="font-medium" id="customerName">Acme Inc.</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email</span>
                            <span class="font-medium" id="customerEmail">contact@acme.com</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Customer ID</span>
                            <span class="font-medium" id="customerId">cus_NffrFeUfNV2Eib</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <h5 class="font-medium text-gray-900 mb-3">Payment Method</h5>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Type</span>
                            <span class="font-medium" id="paymentMethodType">Credit Card</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Card</span>
                            <span class="font-medium" id="paymentMethodDetails">Visa •••• 4242</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Brand</span>
                            <span class="font-medium" id="paymentBrand">Visa</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Amount Breakdown -->
            <div class="bg-gray-50 rounded-xl p-4 mb-6">
                <h5 class="font-medium text-gray-900 mb-3">Amount Details</h5>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-medium" id="subtotalAmount">$2,500.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Tax</span>
                        <span class="font-medium" id="taxAmount">$0.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Discount</span>
                        <span class="font-medium" id="discountAmount">$0.00</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2">
                        <span class="text-gray-900 font-semibold">Total</span>
                        <span class="text-gray-900 font-semibold text-lg" id="totalAmount">$2,500.00</span>
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div class="bg-gray-50 rounded-xl p-4">
                <h5 class="font-medium text-gray-900 mb-3">Additional Information</h5>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Invoice</span>
                        <span class="font-medium" id="invoiceNumber">INV-001</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Currency</span>
                        <span class="font-medium" id="paymentCurrency">USD</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Stripe Fee</span>
                        <span class="font-medium" id="stripeFee">$87.50</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Net Amount</span>
                        <span class="font-medium" id="netAmount">$2,412.50</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-2xl">
            <div class="flex justify-end space-x-3">
                <button onclick="closePaymentDetails()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200">
                    Close
                </button>
                <button class="px-6 py-3 bg-blue-600 text-white rounded-xl font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-print"></i>
                    <span>Print Receipt</span>
                </button>
                <button class="px-6 py-3 bg-green-600 text-white rounded-xl font-medium hover:bg-green-700 transition-colors duration-200 flex items-center space-x-2">
                    <i class="fas fa-redo"></i>
                    <span>Refund</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Payment data for demonstration
    const paymentData = {
        'pay_1Jk8d72eZvKYlo2C': {
            id: 'pay_1Jk8d72eZvKYlo2C',
            date: 'January 15, 2024 at 10:30 AM',
            status: 'Completed',
            customerName: 'Acme Inc.',
            customerEmail: 'contact@acme.com',
            customerId: 'cus_NffrFeUfNV2Eib',
            paymentMethodType: 'Credit Card',
            paymentMethodDetails: 'Visa •••• 4242',
            paymentBrand: 'Visa',
            subtotalAmount: '$2,500.00',
            taxAmount: '$0.00',
            discountAmount: '$0.00',
            totalAmount: '$2,500.00',
            invoiceNumber: 'INV-001',
            paymentCurrency: 'USD',
            stripeFee: '$87.50',
            netAmount: '$2,412.50'
        },
        'pay_2Lm9e83fAwLXmp3D': {
            id: 'pay_2Lm9e83fAwLXmp3D',
            date: 'February 28, 2024 at 02:15 PM',
            status: 'Pending',
            customerName: 'Beta Corp',
            customerEmail: 'billing@beta.com',
            customerId: 'cus_MggsGeVgOW3Fjc',
            paymentMethodType: 'Bank Transfer',
            paymentMethodDetails: 'ACH Transfer',
            paymentBrand: 'Bank',
            subtotalAmount: '$1,800.00',
            taxAmount: '$0.00',
            discountAmount: '$0.00',
            totalAmount: '$1,800.00',
            invoiceNumber: 'INV-002',
            paymentCurrency: 'USD',
            stripeFee: '$0.00',
            netAmount: '$1,800.00'
        },
        'pay_3Mn0f94gBxMYnq4E': {
            id: 'pay_3Mn0f94gBxMYnq4E',
            date: 'March 10, 2024 at 09:45 AM',
            status: 'Completed',
            customerName: 'Gamma LLC',
            customerEmail: 'payments@gamma.com',
            customerId: 'cus_PhhsHeWhPX4Gkd',
            paymentMethodType: 'Credit Card',
            paymentMethodDetails: 'Mastercard •••• 8888',
            paymentBrand: 'Mastercard',
            subtotalAmount: '$3,200.00',
            taxAmount: '$0.00',
            discountAmount: '$0.00',
            totalAmount: '$3,200.00',
            invoiceNumber: 'INV-003',
            paymentCurrency: 'USD',
            stripeFee: '$112.00',
            netAmount: '$3,088.00'
        },
        'pay_4No1g05hCyNZor5F': {
            id: 'pay_4No1g05hCyNZor5F',
            date: 'January 5, 2024 at 04:20 PM',
            status: 'Failed',
            customerName: 'Delta Co.',
            customerEmail: 'finance@delta.com',
            customerId: 'cus_QiiwIfXiQY5Hle',
            paymentMethodType: 'PayPal',
            paymentMethodDetails: 'PayPal Account',
            paymentBrand: 'PayPal',
            subtotalAmount: '$950.00',
            taxAmount: '$0.00',
            discountAmount: '$0.00',
            totalAmount: '$950.00',
            invoiceNumber: 'INV-004',
            paymentCurrency: 'USD',
            stripeFee: '$0.00',
            netAmount: '$0.00'
        },
        'pay_5Op2h16iDzOZps6G': {
            id: 'pay_5Op2h16iDzOZps6G',
            date: 'April 15, 2024 at 11:10 AM',
            status: 'Completed',
            customerName: 'Epsilon Ltd',
            customerEmail: 'accounts@epsilon.com',
            customerId: 'cus_RjjxJgYjRZ6Imf',
            paymentMethodType: 'Digital Wallet',
            paymentMethodDetails: 'Apple Pay',
            paymentBrand: 'Apple Pay',
            subtotalAmount: '$1,250.00',
            taxAmount: '$0.00',
            discountAmount: '$0.00',
            totalAmount: '$1,250.00',
            invoiceNumber: 'INV-005',
            paymentCurrency: 'USD',
            stripeFee: '$43.75',
            netAmount: '$1,206.25'
        }
    };

    function viewPaymentDetails(paymentId) {
        const payment = paymentData[paymentId];
        if (!payment) return;

        // Update modal content with payment data
        document.getElementById('paymentId').textContent = payment.id;
        document.getElementById('paymentDate').textContent = payment.date;
        document.getElementById('customerName').textContent = payment.customerName;
        document.getElementById('customerEmail').textContent = payment.customerEmail;
        document.getElementById('customerId').textContent = payment.customerId;
        document.getElementById('paymentMethodType').textContent = payment.paymentMethodType;
        document.getElementById('paymentMethodDetails').textContent = payment.paymentMethodDetails;
        document.getElementById('paymentBrand').textContent = payment.paymentBrand;
        document.getElementById('subtotalAmount').textContent = payment.subtotalAmount;
        document.getElementById('taxAmount').textContent = payment.taxAmount;
        document.getElementById('discountAmount').textContent = payment.discountAmount;
        document.getElementById('totalAmount').textContent = payment.totalAmount;
        document.getElementById('invoiceNumber').textContent = payment.invoiceNumber;
        document.getElementById('paymentCurrency').textContent = payment.paymentCurrency;
        document.getElementById('stripeFee').textContent = payment.stripeFee;
        document.getElementById('netAmount').textContent = payment.netAmount;

        // Update status badge
        const statusElement = document.getElementById('paymentStatus');
        statusElement.innerHTML = `<i class="fas fa-${getStatusIcon(payment.status)} mr-1"></i>${payment.status}`;
        statusElement.className = `inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${getStatusClass(payment.status)}`;

        // Show modal
        document.getElementById('paymentDetailsModal').classList.remove('hidden');
    }

    function closePaymentDetails() {
        document.getElementById('paymentDetailsModal').classList.add('hidden');
    }

    function getStatusIcon(status) {
        switch(status) {
            case 'Completed': return 'check-circle';
            case 'Pending': return 'clock';
            case 'Failed': return 'times-circle';
            default: return 'question-circle';
        }
    }

    function getStatusClass(status) {
        switch(status) {
            case 'Completed': return 'bg-green-100 text-green-800';
            case 'Pending': return 'bg-yellow-100 text-yellow-800';
            case 'Failed': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }
</script>
@endsection
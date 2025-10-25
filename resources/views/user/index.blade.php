@extends('layouts.app')

@section('title', 'Dashboard - StripePay')

@section('content')
<div class="min-h-screen bg-gray-50">
    @include('components.user-topbar', ['active' => 'dashboard'])

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-8">
        <!-- Welcome Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-display font-semibold text-gray-900 mb-2">Welcome back, John!</h1>
            <p class="text-gray-600">Here's your payment and invoice summary</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Balance -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Total Balance</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">$12,450.00</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center">
                        <i class="fas fa-wallet text-green-600 text-lg"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>12% from last month</span>
                </div>
            </div>

            <!-- Pending Payments -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">Pending Payments</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">3</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-yellow-50 flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-lg"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ url('/user/invoices') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                        <span>View all</span>
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- This Month Revenue -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600 font-medium">This Month</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">$8,450</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i class="fas fa-chart-line text-blue-600 text-lg"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-600">
                    <i class="fas fa-arrow-up mr-1"></i>
                    <span>8% from last month</span>
                </div>
            </div>

            <!-- Overdue Invoices -->
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
                <div class="mt-4">
                    <a href="{{ url('/user/invoices') }}" class="text-sm text-red-600 hover:text-red-800 font-medium flex items-center">
                        <span>View overdue</span>
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Payments Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">Recent Payments</h2>
                        <a href="{{ url('/user/payments') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                            <span>View all</span>
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Payment List -->
                    <div class="space-y-4">
                        <!-- Payment 1 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-150">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Acme Inc.</div>
                                    <div class="text-xs text-gray-500">Today, 10:30 AM</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">$2,500.00</div>
                                <div class="text-xs text-green-600 font-medium">Completed</div>
                            </div>
                        </div>

                        <!-- Payment 2 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-150">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                    <i class="fas fa-clock text-yellow-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Beta Corp</div>
                                    <div class="text-xs text-gray-500">Yesterday, 02:15 PM</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">$1,800.00</div>
                                <div class="text-xs text-yellow-600 font-medium">Pending</div>
                            </div>
                        </div>

                        <!-- Payment 3 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-150">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">Gamma LLC</div>
                                    <div class="text-xs text-gray-500">Mar 10, 09:45 AM</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">$3,200.00</div>
                                <div class="text-xs text-green-600 font-medium">Completed</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <a href="{{ url('/user/payments') }}" class="bg-blue-600 text-white py-3 px-4 rounded-xl font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-list"></i>
                            <span>All Payments</span>
                        </a>
                        <button class="bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-download"></i>
                            <span>Export</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Invoices Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-900">Recent Invoices</h2>
                        <a href="{{ url('/user/invoices') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center">
                            <span>View all</span>
                            <i class="fas fa-arrow-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    <!-- Invoice List -->
                    <div class="space-y-4">
                        <!-- Invoice 1 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-150">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                                    <span class="text-green-600 font-semibold text-sm">INV</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">INV-001</div>
                                    <div class="text-xs text-gray-500">Due Jan 15, 2024</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">$2,500.00</div>
                                <div class="text-xs text-green-600 font-medium">Paid</div>
                            </div>
                        </div>

                        <!-- Invoice 2 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-150">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                                    <span class="text-yellow-600 font-semibold text-sm">INV</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">INV-002</div>
                                    <div class="text-xs text-gray-500">Due Feb 28, 2024</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">$1,800.00</div>
                                <div class="text-xs text-yellow-600 font-medium">Pending</div>
                            </div>
                        </div>

                        <!-- Invoice 3 -->
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors duration-150">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center">
                                    <span class="text-red-600 font-semibold text-sm">INV</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">INV-004</div>
                                    <div class="text-xs text-gray-500">Due Jan 5, 2024</div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-sm font-semibold text-gray-900">$950.00</div>
                                <div class="text-xs text-red-600 font-medium">Overdue</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <a href="{{ url('/user/invoices') }}" class="bg-blue-600 text-white py-3 px-4 rounded-xl font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-file-invoice"></i>
                            <span>All Invoices</span>
                        </a>
                        <button class="bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded-xl font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>New Invoice</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
            <!-- Quick Access -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Quick Access</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ url('/user/payments') }}" class="p-4 border border-gray-200 rounded-xl hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                                <i class="fas fa-credit-card text-blue-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 group-hover:text-blue-700 transition-colors duration-200">Payments</h3>
                                <p class="text-sm text-gray-600">View payment history and details</p>
                            </div>
                        </div>
                    </a>

                    <a href="{{ url('/user/invoices') }}" class="p-4 border border-gray-200 rounded-xl hover:border-green-300 hover:bg-green-50 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                                <i class="fas fa-file-invoice text-green-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 group-hover:text-green-700 transition-colors duration-200">Invoices</h3>
                                <p class="text-sm text-gray-600">Manage and pay your invoices</p>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="p-4 border border-gray-200 rounded-xl hover:border-purple-300 hover:bg-purple-50 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center group-hover:bg-purple-200 transition-colors duration-200">
                                <i class="fas fa-chart-bar text-purple-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 group-hover:text-purple-700 transition-colors duration-200">Analytics</h3>
                                <p class="text-sm text-gray-600">View payment analytics and reports</p>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="p-4 border border-gray-200 rounded-xl hover:border-orange-300 hover:bg-orange-50 transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center group-hover:bg-orange-200 transition-colors duration-200">
                                <i class="fas fa-cog text-orange-600 text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 group-hover:text-orange-700 transition-colors duration-200">Settings</h3>
                                <p class="text-sm text-gray-600">Manage account and payment settings</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Recent Activity</h2>
                <div class="space-y-4">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-green-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Payment received</p>
                            <p class="text-xs text-gray-500">From Acme Inc. • $2,500.00</p>
                            <p class="text-xs text-gray-400">2 hours ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-file-invoice text-blue-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Invoice sent</p>
                            <p class="text-xs text-gray-500">INV-002 to Beta Corp</p>
                            <p class="text-xs text-gray-400">1 day ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-clock text-yellow-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Payment pending</p>
                            <p class="text-xs text-gray-500">From Gamma LLC • $3,200.00</p>
                            <p class="text-xs text-gray-400">2 days ago</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">Invoice overdue</p>
                            <p class="text-xs text-gray-500">INV-004 from Delta Co.</p>
                            <p class="text-xs text-gray-400">3 days ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
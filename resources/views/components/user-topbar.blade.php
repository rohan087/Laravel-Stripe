@php
    // $active should be set in the parent view: 'dashboard', 'invoices', or 'payments'
@endphp
<nav class="glass-effect sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-stripe-purple to-stripe-blue flex items-center justify-center shadow-sm">
                    <i class="fas fa-bolt text-yellow-400 text-sm"></i>
                </div>
                <span class="text-2xl font-display font-semibold text-gray-900">
                    Stripe<span class="text-stripe-purple">Pay</span>
                </span>
            </div>
            <div class="flex-1 flex justify-center">
                <div class="flex items-center space-x-8">
                    <a href="{{ url('/user') }}"
                       class="font-medium transition-colors duration-200 {{ ($active ?? '') === 'dashboard' ? 'text-blue-700 underline underline-offset-8' : 'text-gray-600 hover:text-gray-900' }}">
                        Dashboard
                    </a>
                    <a href="{{ url('/user/invoices') }}"
                       class="font-medium transition-colors duration-200 {{ ($active ?? '') === 'invoices' ? 'text-blue-700 underline underline-offset-8' : 'text-gray-600 hover:text-gray-900' }}">
                        Invoices
                    </a>
                    <a href="{{ url('/user/payments') }}"
                       class="font-medium transition-colors duration-200 {{ ($active ?? '') === 'payments' ? 'text-blue-700 underline underline-offset-8' : 'text-gray-600 hover:text-gray-900' }}">
                        Payments
                    </a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-right hidden md:block">
                    <div class="text-sm font-medium text-gray-900">John Doe</div>
                    <div class="text-xs text-gray-500">john@example.com</div>
                </div>
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                    <span class="text-white text-sm font-medium">JD</span>
                </div>
            </div>
        </div>
    </div>
</nav>

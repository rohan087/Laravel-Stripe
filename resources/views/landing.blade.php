@extends('layouts.app')

@section('title', 'StripePay - Laravel Stripe Integration')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Navigation -->
    <nav class="glass-effect sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-stripe-purple to-stripe-blue flex items-center justify-center shadow-sm">
                        <i class="fas fa-bolt text-white text-sm"></i>
                    </div>
                    <span class="text-2xl font-display font-semibold text-gray-900">
                        Stripe<span class="text-stripe-purple">Pay</span>
                    </span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">Features</a>
                    <a href="#demo" class="text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">Demo</a>
                    <a href="#docs" class="text-gray-600 hover:text-gray-900 font-medium transition-colors duration-200">Docs</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-gray-900 font-medium hidden md:block">Sign In</a>
                    <a href="#" class="bg-gray-900 text-white px-6 py-2 rounded-lg font-medium hover:bg-gray-800 transition-colors duration-200">
                        Get Started
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-20 md:py-32 px-6">
        <div class="max-w-4xl mx-auto text-center animate-fade-in">
            <div class="inline-flex items-center space-x-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-full text-sm font-medium mb-8">
                <i class="fas fa-rocket"></i>
                <span>Now available for Laravel 10+</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-display font-semibold text-gray-900 mb-6 leading-tight">
                Seamless
                <span class="text-gradient">Stripe</span>
                <br>Integration
            </h1>
            
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto leading-relaxed">
                A minimalist Laravel package for processing payments, managing subscriptions, 
                and handling invoices with Stripe. Clean, modern, and developer-friendly.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="#demo" class="bg-gray-900 text-white px-8 py-4 rounded-xl font-medium hover:bg-gray-800 transition-colors duration-200 hover-lift flex items-center space-x-2">
                    <i class="fas fa-play"></i>
                    <span>Explore Demo</span>
                </a>
                <a href="#" class="border border-gray-300 text-gray-700 px-8 py-4 rounded-xl font-medium hover:border-gray-400 transition-colors duration-200 hover-lift flex items-center space-x-2">
                    <i class="fab fa-github"></i>
                    <span>View on GitHub</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-20 bg-gray-50/50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-semibold text-gray-900 mb-4">
                    Everything You Need
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Clean, focused features for modern payment processing
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover-lift border border-gray-100">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mb-6">
                        <i class="fas fa-credit-card text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Payment Processing</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Secure, PCI-compliant payment processing with support for all major payment methods.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover-lift border border-gray-100">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center mb-6">
                        <i class="fas fa-sync-alt text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Subscriptions</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Manage recurring billing, plan changes, and customer subscriptions with ease.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover-lift border border-gray-100">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center mb-6">
                        <i class="fas fa-file-invoice text-white text-lg"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Invoicing</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Generate professional invoices, send automated reminders, and track payments.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Section -->
    <section id="demo" class="py-20 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-semibold text-gray-900 mb-4">
                    Experience the Demo
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Explore our Laravel Stripe integration from different perspectives
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- User Portal -->
                <div class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover-lift">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-blue-500 transform group-hover:translate-x-1 transition-transform duration-200 text-xl"></i>
                    </div>
                    
                    <h3 class="text-2xl font-semibold text-gray-900 mb-3">User Portal</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Browse products, make test purchases, and experience the customer payment flow.
                    </p>
                    
                    <a href="{{ url('/user') }}" class="inline-flex items-center space-x-2 text-blue-600 font-medium hover:text-blue-700 transition-colors duration-200">
                        <span>Enter User Portal</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                    <div class="mt-4 flex flex-col gap-2">
                        <a href="{{ url('/user/invoices') }}" class="text-blue-500 hover:underline text-sm">View Invoices</a>
                        <a href="{{ url('/user/payments') }}" class="text-blue-500 hover:underline text-sm">View Payments</a>
                    </div>
                </div>
                
                <!-- Admin Portal -->
                <div class="group bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover-lift">
                    <div class="flex items-start justify-between mb-6">
                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                            <i class="fas fa-cog text-white text-xl"></i>
                        </div>
                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-gray-700 transform group-hover:translate-x-1 transition-transform duration-200 text-xl"></i>
                    </div>
                    
                    <h3 class="text-2xl font-semibold text-gray-900 mb-3">Admin Portal</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Manage products, view transactions, and monitor payment analytics.
                    </p>
                    
                    <a href="http://laravel-stripe.test/admin" class="inline-flex items-center space-x-2 text-gray-700 font-medium hover:text-gray-900 transition-colors duration-200">
                        <span>Enter Admin Portal</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>
            
            <div class="text-center mt-12 p-6 bg-blue-50 rounded-2xl">
                <p class="text-blue-600 font-medium">
                    <i class="fas fa-shield-alt mr-2"></i>
                    Safe testing environment - no real payments processed
                </p>
            </div>
        </div>
    </section>

    <!-- Integration Steps -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-semibold mb-4">
                    Simple Integration
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Get started in minutes, not hours
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-6 text-white font-semibold text-xl">
                        1
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Install</h3>
                    <p class="text-gray-300">Install via Composer</p>
                    <code class="block mt-4 p-3 bg-gray-800 rounded-lg text-sm font-mono text-blue-300">
                        composer require stripe-pay
                    </code>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-6 text-white font-semibold text-xl">
                        2
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Configure</h3>
                    <p class="text-gray-300">Add your Stripe keys</p>
                    <code class="block mt-4 p-3 bg-gray-800 rounded-lg text-sm font-mono text-blue-300">
                        STRIPE_KEY=your_key<br>
                        STRIPE_SECRET=your_secret
                    </code>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full bg-white/10 flex items-center justify-center mx-auto mb-6 text-white font-semibold text-xl">
                        3
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Implement</h3>
                    <p class="text-gray-300">Start processing payments</p>
                    <code class="block mt-4 p-3 bg-gray-800 rounded-lg text-sm font-mono text-blue-300">
                        StripePay::charge($amount);
                    </code>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-display font-semibold text-gray-900 mb-6">
                Ready to Get Started?
            </h2>
            <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Join thousands of developers who process payments seamlessly with our Laravel Stripe integration.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-gray-900 text-white px-8 py-4 rounded-xl font-medium hover:bg-gray-800 transition-colors duration-200 hover-lift">
                    Get Started Free
                </a>
                <a href="#" class="border border-gray-300 text-gray-700 px-8 py-4 rounded-xl font-medium hover:border-gray-400 transition-colors duration-200 hover-lift">
                    Read Documentation
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-gray-200">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-6 md:mb-0">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-stripe-purple to-stripe-blue flex items-center justify-center">
                        <i class="fas fa-bolt text-white text-xs"></i>
                    </div>
                    <span class="text-xl font-display font-semibold text-gray-900">
                        Stripe<span class="text-stripe-purple">Pay</span>
                    </span>
                </div>
                
                <div class="flex items-center space-x-6 text-gray-600">
                    <a href="#" class="hover:text-gray-900 transition-colors duration-200">
                        <i class="fab fa-github text-lg"></i>
                    </a>
                    <a href="#" class="hover:text-gray-900 transition-colors duration-200">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="hover:text-gray-900 transition-colors duration-200">
                        <i class="fab fa-discord text-lg"></i>
                    </a>
                </div>
            </div>
            
            <div class="border-t border-gray-200 mt-8 pt-8 text-center">
                <p class="text-gray-500 text-sm">
                    © 2025 StripePay Laravel Integration. Crafted with precision and care.
                </p>
            </div>
        </div>
    </footer>
</div>
@endsection
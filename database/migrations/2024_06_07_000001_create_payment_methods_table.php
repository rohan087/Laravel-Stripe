<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('provider'); // 'stripe' or 'paypal'
            $table->string('provider_payment_method_id');
            $table->string('type'); // 'card', 'us_bank_account', 'paypal'
            $table->string('brand')->nullable(); // For cards
            $table->string('last4')->nullable(); // For cards/bank
            $table->integer('exp_month')->nullable(); // For cards
            $table->integer('exp_year')->nullable(); // For cards
            $table->string('bank_name')->nullable(); // For bank accounts
            $table->string('email')->nullable(); // For PayPal
            $table->boolean('is_default')->default(false);
            $table->json('meta')->nullable(); // Extra data
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['user_id', 'provider']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}

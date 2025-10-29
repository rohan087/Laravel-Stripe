<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_payment_id')->nullable();
            $table->string('payment_method_type')->nullable();
            $table->json('payment_method_details')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('usd');
            $table->string('status')->default('pending');
            $table->text('description')->nullable();
            $table->timestamp('paid_at')->nullable(); // <-- Add this line
            $table->string('recipient')->nullable(); // <-- Add this line
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
            $table->index(['user_id', 'provider']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
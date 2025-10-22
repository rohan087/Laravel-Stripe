<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::insert([
            [
                'customer_name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'amount' => 29.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'amount' => 49.50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_name' => 'Carol Davis',
                'email' => 'carol@example.com',
                'amount' => 75.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        Invoice::insert([
            [
                'user_id' => 1,
                'number' => 'INV-001',
                'amount' => 2500.00,
                'status' => 'Paid',
                'due_date' => '2024-01-15',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'number' => 'INV-002',
                'amount' => 1800.00,
                'status' => 'Pending',
                'due_date' => '2024-02-28',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'number' => 'INV-004',
                'amount' => 950.00,
                'status' => 'Overdue',
                'due_date' => '2024-01-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

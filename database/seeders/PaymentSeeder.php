<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        Payment::insert([
            [
                'user_id' => 1,
                'amount' => 2500.00,
                'status' => 'Completed',
                'paid_at' => now(),
                'recipient' => 'Acme Inc.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'amount' => 1800.00,
                'status' => 'Pending',
                'paid_at' => now()->subDay(),
                'recipient' => 'Beta Corp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'amount' => 3200.00,
                'status' => 'Completed',
                'paid_at' => now()->subDays(10),
                'recipient' => 'Gamma LLC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

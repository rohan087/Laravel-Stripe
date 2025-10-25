<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin User', // Ensure 'name' is included
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}

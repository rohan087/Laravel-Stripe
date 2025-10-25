<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'John Doe', 'email' => 'john@example.com', 'password' => Hash::make('password')],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'password' => Hash::make('password')],
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com', 'password' => Hash::make('password')],
            ['name' => 'Bob Brown', 'email' => 'bob@example.com', 'password' => Hash::make('password')],
            ['name' => 'Charlie Davis', 'email' => 'charlie@example.com', 'password' => Hash::make('password')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

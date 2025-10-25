<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'card_surcharge_percent'],
            ['value' => '4.5']
        );
    }
}

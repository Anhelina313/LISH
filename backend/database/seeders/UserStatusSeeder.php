<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_statuses')->insertOrIgnore([
            ['name' => 'registered'],
            ['name' => 'active'],
            ['name' => 'inactive'],
        ]);
    }
}

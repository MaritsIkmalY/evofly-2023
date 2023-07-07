<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin.evofly@gmail.com',
                'password' => '$2a$12$ijAo6V7oqhjKyHjBzxVIP.V8rbYX9h9bd5QxYpdkpOQsUaZLO5QU.',
                'role_id' => 1
            ]
        ]);
    }
}

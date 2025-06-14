<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
    'name' => 'Admin Google',
    'email' => 'zamzamnurs380@gmail.com',
    'google_id' => null,
    'avatar' => null,
    'password' => null, // Password bisa null untuk Google-only admin
    'created_at' => now(),
    'updated_at' => now(),
]);
    }
}

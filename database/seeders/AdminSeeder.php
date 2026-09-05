<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'admin_name' => 'Saiful alam',
            'email' => 'mdsaifula18@gmail.com',
            'password' => Hash::make('saifulvai11'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

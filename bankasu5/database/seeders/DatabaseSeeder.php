<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // Bankasu5 users
        DB::table('users')->insert([
            'name' => 'Aušra',
            'email' => 'ausra@bankasu5.test',
            'password' => Hash::make('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'darbuotojas1',
            'email' => 'darbuotojas1@bankasu5.test',
            'password' => Hash::make('123'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Panitia',
            'email' => 'panitia@zakat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('panitia11'),
            'type' => 1, // panitia
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Muzakki',
            'email' => 'muzakki@zakat.com',
            'email_verified_at' => now(),
            'password' => Hash::make('muzakki'),
            'type' => 2, // muzakki
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

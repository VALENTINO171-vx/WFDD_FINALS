<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
        [
            'user_id' => 1,
            'user_name' => 'admin',
            'user_email' => 'admin@example.com',
            'user_password' => Hash::make('root'),
            'user_role' => 'admin',
        ],[
            'user_id' => 2,
            'user_name' => 'userA',
            'user_email' => 'userA@example.com',
            'user_password' => Hash::make('laravel'),
            'user_role' => 'user',
        ],[
            'user_id' => 3,
            'user_name' => 'userB',
            'user_email' => 'userB@example.com',
            'user_password' => Hash::make('laragon'),
            'user_role' => 'user',
        ],[
            'user_id' => 4,
            'user_name' => 'userC',
            'user_email' => 'userC@example.com',
            'user_password' => Hash::make('artisan'),
            'user_role' => 'user',
        ]
        
        ]);

    }
}

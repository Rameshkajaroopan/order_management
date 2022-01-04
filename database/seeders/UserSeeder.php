<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'kopi',
            'role' =>'admin',
            'mobile' =>Str::random(10),
            'user_name' => 'kopi',
            'email' => 'kopi@gmail.com',
            'branch_id' => 1,
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'thusapan',
            'role' =>'admin',
            'mobile' =>Str::random(10),
            'email' => 'thusapan@gmail.com',
            'user_name' => 'thusapan',
            'branch_id' => 2,
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'kalai',
            'role' =>'admin',
            'mobile' =>Str::random(10),
            'email' => 'kalai@gmail.com',
            'user_name' => 'kalai',
            'branch_id' => 3,
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'nilavan',
            'role' =>'admin',
            'mobile' =>Str::random(10),
            'email' => 'nilavan@gmail.com',
            'branch_id' => 4,
            'user_name' => 'nilavan',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'mayuran',
            'role' =>'admin',
            'mobile' =>Str::random(10),
            'email' => 'mayuran@gmail.com',
            'branch_id' => 4,
            'user_name' => 'mayuran',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => 'kajan',
            'role' =>'admin',
            'mobile' =>Str::random(10),
            'email' => 'kajan@gmail.com',
            'branch_id' => 2,
            'user_name' => 'kajan',
            'password' => Hash::make('password'),
        ]);

    }
}

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
            'last_name' => 'kopi',
            'role' =>'user',
            'mobile' =>Str::random(10),
            'user_name' => 'kopi',
            'email' => 'kopi@gmail.com',
            'branch_id' => 1,
            'password' => 'password',
        ]);

        DB::table('users')->insert([
            'first_name' => 'thusapan',
            'last_name' => 'thusapan',
            'role' =>'user',
            'mobile' =>Str::random(10),
            'email' => 'thusapan@gmail.com',
            'user_name' => 'thusapan',
            'branch_id' => 2,
            'password' => 'password',
        ]);

        DB::table('users')->insert([
            'first_name' => 'kalai',
            'last_name' => 'kalai',
            'role' =>'user',
            'mobile' =>Str::random(10),
            'email' => 'kalai@gmail.com',
            'user_name' => 'kalai',
            'branch_id' => 1,
            'password' => 'password',
        ]);

        DB::table('users')->insert([
            'first_name' => 'nilavan',
            'last_name' => 'nilavan',
            'role' =>'user',
            'mobile' =>Str::random(10),
            'email' => 'nilavan@gmail.com',
            'branch_id' => 2,
            'user_name' => 'nilavan',
            'password' => 'password',
        ]);

        DB::table('users')->insert([
            'first_name' => 'nilavan',
            'last_name' => 'nilavan',
            'role' =>'super_user',
            'mobile' =>Str::random(10),
            'email' => 'mayuran@gmail.com',
            'branch_id' => 2,
            'user_name' => 'mayuran',
            'password' => 'password',
        ]);

        DB::table('users')->insert([
            'first_name' => 'kajan',
            'last_name' => 'ramesh',
            'role' =>'super_user',
            'mobile' =>Str::random(10),
            'email' => 'kajan@gmail.com',
            'branch_id' => 1,
            'user_name' => 'kajan',
            'password' => 'password',
        ]);
        DB::table('users')->insert([
            'first_name' => 'admin',
            'last_name' => 'kalai',
            'role' =>'admin',
            'mobile' =>Str::random(10),
            'email' => 'kajan@gmail.com',
            'branch_id' => Null,
            'user_name' => 'admin',
            'password' => 'password',
        ]);
    }
}

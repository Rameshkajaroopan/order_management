<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = DB::table('branches')->pluck('name');
        $branches = (array)$branches;
        $branches = ['A', 'B', 'C'];
        $working_status = ['NotStart', 'InProgress', 'Stuck', 'Completed'];


        foreach (range(1, 5) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Cash",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => 1,
                'current_location' => 'Branch1',
                'address' =>  Str::random(10),
                'working_status' => 'NotStart'
            ]);
        }
        foreach (range(6, 20) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Cash",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => 1,
                'current_location' => 'Branch1',
                'address' =>  Str::random(10),
                'working_status' => 'InProgress'
            ]);
        }
        foreach (range(21, 25) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Cash",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => 1,
                'current_location' => 'Branch1',
                'address' =>  Str::random(10),
                'working_status' => 'Stuck'
            ]);
        }
        foreach (range(26, 30) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Cash",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => 1,
                'current_location' => 'Branch1',
                'address' =>  Str::random(10),
                'working_status' => 'Completed'
            ]);
        }
        
        //branch 2
        foreach (range(31, 35) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Card",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 2,
                'created_user_id' => 2,
                'current_location' => 'Branch2',
                'address' =>  Str::random(10),
                'working_status' => 'NotStart'
            ]);
        }
        foreach (range(36, 50) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Card",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 2,
                'created_user_id' => 2,
                'current_location' => 'Branch2',
                'address' =>  Str::random(10),
                'working_status' => 'InProgress'
            ]);
        }
        foreach (range(51, 55) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Cash",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 2,
                'created_user_id' => 2,
                'current_location' => 'Branch2',
                'address' =>  Str::random(10),
                'working_status' => 'Stuck'
            ]);
        }
        foreach (range(56, 60) as $index) {
            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' =>"Card",
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 2,
                'created_user_id' => 2,
                'current_location' => 'Branch2',
                'address' =>  Str::random(10),
                'working_status' => 'Completed'
            ]);
        }

       
    }
}

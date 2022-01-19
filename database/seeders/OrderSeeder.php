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


        foreach (range(1, 10) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => 1,
                'current_location' => 'A',
                'address' =>  Str::random(10),
                'working_status' => 'InProgress'
            ]);
        }
        foreach (range(11, 17) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 2,
                'created_user_id' => 2,
                'current_location' => 'B',
                'address' =>  Str::random(10),
                'working_status' => 'InProgress'
            ]);
        }
        foreach (range(11, 17) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 3,
                'created_user_id' => 3,
                'current_location' => 'C',
                'address' =>  Str::random(10),
                'working_status' => 'InProgress',
            ]);
        }

        foreach (range(18, 23) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' .$index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => 1,
                'current_location' => 'C',
                'address' =>  Str::random(10),
                'working_status' => 'InProgress',
            ]);
        }
        foreach (range(24, 27) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 2,
                'created_user_id' => rand(1, 6),
                'current_location' => 'A',
                'address' =>  Str::random(10),
                'working_status' => 'Completed',
            ]);
        }

        foreach (range(28, 30) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 3,
                'created_user_id' => rand(1, 6),
                'current_location' => 'C',
                'address' =>  Str::random(10),
                'working_status' => 'Completed',
            ]);
        }

        foreach (range(31, 34) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => rand(1, 6),
                'current_location' => 'A',
                'address' =>  Str::random(10),
                'working_status' => 'Stuck',
            ]);
        }
        foreach (range(35, 40) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'order-' . $index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100, 500),
                'paid_amount' => rand(50, 100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => 1,
                'created_user_id' => rand(1, 6),
                'current_location' => 'A',
                'address' =>  Str::random(10),
                'working_status' => 'NotStart',
            ]);
        }
    }
}

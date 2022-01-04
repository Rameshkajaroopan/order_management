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
        $branches = ['A','B','C','D'];
        $working_status = ['NotStart','InProgress','Stuck','Completed'];
        
        
        foreach (range(1, 60) as $index) {

            DB::table('orders')->insert([
                'serial_number' => 'invoice->'.$index,
                'customer_name' => Str::random(10),
                'mobile' => str::random(10),
                'Item' => Str::random(10),
                'weight' => Str::random(10),
                'total_amount' =>  rand(100,500),
                'paid_amount' => rand(50,100),
                'payment_mode' => Str::random(10),
                'created_date' => Carbon::now(),
                'due_date' => Carbon::now(),
                'created_branch_id' => rand(1,5),  
                'created_user_id' => rand(1,5),     
                'current_location' => $branches[array_rand($branches)],
                'address' =>  Str::random(10),
                'working_status' => $working_status[array_rand($working_status)]
            ]);

        }
       
    }
}

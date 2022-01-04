<?php

namespace Database\Seeders;

use App\Models\OrderTransfer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;




class OrdertransferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1, 20) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(1,20),
                'requested_branch_id' =>  rand(1, 2),
                'approved_branch_id' => rand(3, 5),
                'requested_user_id' => rand(1, 2),
                'location_status' => 'InTransit',
                'request_status' => 'NotApproved',

            ]);
        }

        foreach (range(20, 40) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(1,20),
                'requested_branch_id' =>  rand(1, 2),
                'approved_branch_id' => rand(3, 5),
                'requested_user_id' => rand(1, 2),
                'approved_user_id' => rand(3, 5),
                'location_status' => 'TxPkxPCb',
                'approved_date' => Carbon::now(),
                'request_status' => 'Approved',

            ]);
        }

        foreach (range(20, 25) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(1,20),
                'requested_branch_id' =>  rand(1, 2),
                'approved_branch_id' => rand(3, 5),
                'requested_user_id' => rand(1, 2),
                'approved_user_id' => rand(3, 5),
                'location_status' => 'B',
                'approved_date' => Carbon::now(),
                'request_status' => 'Approved',

            ]);
        }


        foreach (range(25, 40) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(1,20),
                'requested_branch_id' =>  rand(1, 2),
                'approved_branch_id' => rand(3, 5),
                'requested_user_id' => rand(1, 2),
                'approved_user_id' => rand(3, 5),
                'location_status' => 'TxPkxPCb',
                'approved_date' => Carbon::now(),
                'request_status' => 'Approved',

            ]);
        }

        foreach (range(40, 60) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(1,20),
                'requested_branch_id' =>  rand(1, 2),
                'approved_branch_id' => rand(3, 5),
                'requested_user_id' => rand(1, 2),
                'approved_user_id' => rand(3, 5),
                'location_status' => 'C',
                'approved_date' => Carbon::now(),
                'request_status' => 'Approved',

            ]);
        }


    }
}

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
    // test
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach (range(1, 10) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(1, 10),
                'requested_branch_id' =>  1,
                'approved_branch_id' => 2,
                'requested_user_id' => 1,
                'location_status' => 'InTransit',
                'request_status' => 'NotApproved',

            ]);
        }

        foreach (range(11, 20) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(11, 20),
                'requested_branch_id' => 1,
                'approved_branch_id' => 2,
                'requested_user_id' => 1,
                'approved_user_id' => 2,
                'location_status' => 'location2',
                'approved_date' => Carbon::now(),
                'request_status' => 'Approved',

            ]);
        }

        foreach (range(21, 30) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => rand(21, 28),
                'requested_branch_id' => 1,
                'approved_branch_id' =>2,
                'requested_user_id' => 1,
                'approved_user_id' => 2,
                'location_status' => 'B',
                'approved_date' => Carbon::now(),
                'request_status' => 'Approved',
            ]);
        }


        foreach (range(31, 33) as $index) {
            OrderTransfer::create([

                'requested_date' => Carbon::now(),
                'order_id' => rand(31, 33),
                'requested_branch_id' =>  1,
                'approved_branch_id' => 2,
                'requested_user_id' => 1,
                'approved_user_id' => 3,
                'location_status' => 'C',
                'approved_date' => Carbon::now(),
                'request_status' => 'Approved',

            ]);
        }

       
    }
}

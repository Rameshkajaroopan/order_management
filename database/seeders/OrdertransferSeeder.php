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

        foreach (range(6, 10) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  1,
                'approved_branch_id' => 2,
                'requested_user_id' => 1,
                'location_status' => 'InTransit',
                'request_status' => 'NotApproved',
            ]);
        }

        foreach (range(11, 15) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  1,
                'approved_branch_id' => 2,
                'requested_user_id' => 1,
                'location_status' => 'Branch2',
                'request_status' => 'Approved',
                'approved_date' => Carbon::now(),
            ]);
        }

        foreach (range(16, 20) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  1,
                'approved_branch_id' => 2,
                'requested_user_id' => 1,
                'location_status' => 'Location2',
                'request_status' => 'Approved',
                'approved_date' => Carbon::now(),
            ]);
        }

        foreach (range(26, 30) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  1,
                'approved_branch_id' => 2,
                'requested_user_id' => 1,
                'location_status' => 'Location2',
                'request_status' => 'Approved',
                'approved_date' => Carbon::now(),
            ]);
        }

        //next branch

        foreach (range(36, 40) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  2,
                'approved_branch_id' => 1,
                'requested_user_id' => 2,
                'location_status' => 'InTransit',
                'request_status' => 'NotApproved',
            ]);
        }

        foreach (range(41, 45) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  2,
                'approved_branch_id' => 1,
                'requested_user_id' => 2,
                'location_status' => 'Branch1',
                'request_status' => 'Approved',
                'approved_date' => Carbon::now(),
            ]);
        }

        foreach (range(46, 50) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  2,
                'approved_branch_id' => 1,
                'requested_user_id' => 2,
                'location_status' => 'Location1',
                'request_status' => 'Approved',
                'approved_date' => Carbon::now(),
            ]);
        }

        foreach (range(56, 60) as $index) {
            OrderTransfer::create([
                'requested_date' => Carbon::now(),
                'order_id' => $index,
                'requested_branch_id' =>  2,
                'approved_branch_id' => 1,
                'requested_user_id' => 2,
                'location_status' => 'Location2',
                'request_status' => 'Approved',
                'approved_date' => Carbon::now(),
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Location;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderTransfer;

class SingleOrderController extends Controller
{
    public function singleOrder(Request $request)
    {
        $serial_number = $request->input('serial_number');

        $orderId =  Order::where('serial_number', '=', $serial_number)->value('id');
        $singleOrderTransferId = OrderTransfer::where('order_id', '=', $orderId)->value('id');

        $singleOrder = Order::find($orderId);
      
        $created_branch_id =    $singleOrder->created_branch_id;
       
        $created_branch_name = Branch::where('id', $created_branch_id)->value('name');
     
        $created_user_id =  $singleOrder->created_user_id;
        $created_user_name = User::where('id', $created_user_id)->value('first_name');

        if ($singleOrderTransferId) {
            $singleOrderTransfer = OrderTransfer::find($singleOrderTransferId);

            $requested_branch_id =    $singleOrderTransfer->requested_branch_id;
            $requested_branch_name = Branch::where('id', $requested_branch_id)->value('name');

            $approved_branch_id =    $singleOrderTransfer->approved_branch_id;
            $approved_branch_name = Branch::where('id', $approved_branch_id)->value('name');

            $requested_user_id =    $singleOrderTransfer->requested_user_id;
            $requested_user_name = User::where('id', $requested_user_id)->value('first_name');

            $approved_user_id =    $singleOrderTransfer->approved_user_id;
            $approved_user_name = User::where('id', $approved_user_id)->value('first_name');

            return response()->json([
                'cutomer_name' => $singleOrder->customer_name,
                'mobile' => $singleOrder->mobile,
                'Item' => $singleOrder->Item,
                'weight' => $singleOrder->weight,
                'total_amount' => $singleOrder->total_amount,
                'paid_amount' => $singleOrder->paid_amount,
                'created_branch_name' =>  $created_branch_name,
                'created_user_name' => $created_user_name,
                'address' => $singleOrder->address,
                'working_status' =>  $singleOrder->working_status,
                'requested_branch_name' =>   $requested_branch_name,
                'approved_branch_name ' => $approved_branch_name,
                'requested_user_name ' => $requested_user_name,
                'approved_user_name' => $approved_user_name,
                'requested_date' =>  $singleOrderTransfer->requested_date,
                'approved_date' =>  $singleOrderTransfer->approved_date,
                'location_status' =>  $singleOrderTransfer->location_status,
            ]);
        } else {
            return response()->json([
                'cutomer_name' => $singleOrder->customer_name,
                'mobile' => $singleOrder->mobile,
                'Item' => $singleOrder->Item,
                'weight' => $singleOrder->weight,
                'total_amount' => $singleOrder->total_amount,
                'paid_amount' => $singleOrder->paid_amount,
                'created_branch_name' =>  $created_branch_name,
                'created_user_name' => $created_user_name,
                'address' => $singleOrder->address,
                'working_status' =>  $singleOrder->working_status,
                'requested_branch_name' =>   '',
                'approved_branch_name ' => '',
                'requested_user_name ' => '',
                'approved_user_name' =>'',
                'requested_date' => '',
                'approved_date' => '',
                'location_status' => '',
            ]);
        }
    }
    public function branchLocation()
    {
        $branches = Branch::get();
        $locations = Location::get();

        return response()->json(['branches' => $branches, 'locations' => $locations]);
    }
}

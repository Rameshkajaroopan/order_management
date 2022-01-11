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
        $order_page = $request->input('order_page');

        $orderId =  Order::where('serial_number', '=', $serial_number)->value('id');
        $singleOrderTransferId = OrderTransfer::where('order_id', '=', $orderId)->value('id');

        $singleOrder = Order::find($orderId);
        $singleOrderTransfer = OrderTransfer::find($singleOrderTransferId);



        return response()->json([
            'cutomer_name' => $singleOrder->customer_name,
            'mobile' => $singleOrder->mobile,
            'Item' => $singleOrder->Item,
            'weight' => $singleOrder->weight,
            'total_amount' => $singleOrder->total_amount,
            'paid_amount' => $singleOrder->paid_amount,
            'created_branch_name' => $singleOrder->branch->name,
            'created_user_name' => $singleOrder->user->first_name,
            'address' => $singleOrder->address,
            'working_status' =>  $singleOrder->working_status,
            'requested_branch_id' =>   $singleOrderTransfer->requestBranch->name,
            'approved_branch_id ' => $singleOrderTransfer->approvedBranch->name,
            'requested_user_id ' => $singleOrderTransfer->requestUser->first_name,
            'approved_user_id ' => $singleOrderTransfer->approvedUser->first_name,
            'requested_date' =>  $singleOrderTransfer->requested_date,
            'approved_date' =>  $singleOrderTransfer->approved_date,
            'location_status' =>  $singleOrderTransfer->location_status,
        ]);
    }
}

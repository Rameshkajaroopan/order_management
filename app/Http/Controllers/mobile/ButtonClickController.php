<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use Session;
use Carbon\Carbon;
use App\Models\OrderTransfer;

class ButtonClickController extends Controller
{
    public function sendRequest(Request $request)
    {
        $order_id = Order::where('serial_number', $request->serial_number)->value('id');
        $OrderTransfer =   new OrderTransfer;
        $OrderTransfer->order_id =   $order_id;
        $OrderTransfer->requested_branch_id = Auth::user()->branch_id;
        $OrderTransfer->approved_branch_id  = $request->approved_branch_id;
        $OrderTransfer->requested_date = Carbon::now();
        $OrderTransfer->requested_user_id  =  Auth::user()->id;
        $OrderTransfer->current_location  =  "InTransit";
        $OrderTransfer->request_status  =  "NotApproved";
        $OrderTransfer->save();
        Order::where('serial_number', $request->serial_number)->update([
            'working_status' => 'InProgress'
        ]);
        return response()->json(["successfully send a request"]);
       
    }
 
    public function deliverSameBranch(Request $request)
    {
        $branchName = Branch::where('id', Auth::user()->branch_id)->value('name');

        Order::where('serial_number', $request->serial_number)->update([
            'current_location' =>  $branchName,
            'working_status' => 'Completed',
        ]);
    }

    public function approved(Request $request)
    {
        $branchName = Branch::where('id', Auth::user()->branch_id)->value('name');

        $orderId = Order::where('serial_number', $request->serial_number)->value('id');
        OrderTransfer::where('order_id', $orderId)
            ->update([
                'request_status' => 'Approved',
                'approved_date' =>  Carbon::now(),
                'location_status' =>  $branchName
            ]);
    }

    public function changeLocation(Request $request)

    {
        $location = $request->location;

        $orderId = Order::where('serial_number', $request->serial_number)->value('id');
        OrderTransfer::where('order_id', $orderId)
            ->update([
                'location_status' => $location
            ]);
    }

    public function stuckOrderRequest(Request $request)

    {
        Order::where('serial_number', $request->serial_number)->update([
            'working_status' => 'Stuck'
        ]);
    }

    public function orderSearch(Request $request)
    {
       
        $serial_number = $request->serial_number;

        $searOrder = Order::where('serial_number','like', '%'.$serial_number.'%')
        ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name')
        ->get();

        return response()->json([ 'searOrder' =>  $searOrder]);

    }
}

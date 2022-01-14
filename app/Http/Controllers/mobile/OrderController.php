<?php

namespace App\Http\Controllers\mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Location;


class OrderController extends Controller
{
    public function newOrder()
    {

        $branchId = Auth::user()->branch_id;

        $createdOrder = Order::where('created_branch_id', '=', $branchId)
            ->where('working_status', '=', 'NotStart')
            ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name', 'orders.created_date as created_date')
            ->get();

        return response()->json(['createdOrder' => $createdOrder]);
    }

    public function sentApprovedOrder()
    {
        $branchId = Auth::user()->branch_id;

        $sentApprovedOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.requested_branch_id', '=', $branchId)
            ->where('order_transfers.request_status', '=', 'Approved')
            ->where('orders.working_status', '=', 'InProgress')
            ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name', 'orders.created_date as created_date')->get();

        $locations = Location::all();

        $sentApprovedOrderCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.requested_branch_id', '=', $branchId)
            ->where('order_transfers.request_status', '=', 'Approved')
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        return response()->json(['sentApprovedOrder' => $sentApprovedOrder, 'locations' => $locations, 'sentApprovedOrderCount' =>  $sentApprovedOrderCount]);
    }


    public function sentNotApprovedOrder()
    {
        $branchId = Auth::user()->branch_id;

        $sentNotApprovedOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.requested_branch_id', '=', $branchId)
            ->where('order_transfers.location_status', '=', 'InTransit')
            ->where('orders.working_status', '=', 'InProgress')
            ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name', 'orders.created_date as created_date')
            ->get();

        $sentNotApprovedOrderCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.requested_branch_id', '=', $branchId)
            ->where('order_transfers.location_status', '=', 'InTransit')
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        return response()->json(['sentNotApprovedOrder' => $sentNotApprovedOrder, 'sentNotApprovedOrderCount' =>  $sentNotApprovedOrderCount]);
    }

    public function notificationOrder()
    {
        $branchId = Auth::user()->branch_id;

        $notificationOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('order_transfers.request_status', '=', 'NotApproved')
            ->where('orders.working_status', '=', 'InProgress')
            ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name', 'orders.created_date as created_date')
            ->get();

        $notificationOrderCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('order_transfers.request_status', '=', 'NotApproved')
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        return response()->json(['notificationOrder' => $notificationOrder, 'notificationOrderCount' => $notificationOrderCount]);
    }

    public function  receivedNotCompletedOrder()
    {
        $branchId = Auth::user()->branch_id;

        $receivedNotCompletedOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->where('order_transfers.request_status', '=', 'Approved')
            ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name', 'orders.created_date as created_date')
            ->get();

        $receivedNotCompletedOrderCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->where('order_transfers.request_status', '=', 'Approved')
            ->count();

        return response()->json(['receivedNotCompletedOrder' => $receivedNotCompletedOrder, 'receivedNotCompletedOrderCount' => $receivedNotCompletedOrderCount]);
    }

    public function  receivedCompletedOrder()
    {
        $branchId = Auth::user()->branch_id;

        $receivedCompletedOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'Completed')
            ->whereDate('orders.updated_at', '=', Carbon::now()->toDateString() )
            ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name', 'orders.created_date as created_date')
            ->get();

        return response()->json(['receivedCompletedOrder' => $receivedCompletedOrder]);
    }

    public function  stuckOrder()
    {
        $branchId = Auth::user()->branch_id;

        $stuckOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('orders.working_status', '=', 'Stuck')
            ->where(
                function ($query) use ($branchId) {
                    return $query
                        ->where('order_transfers.approved_branch_id', '=', $branchId)
                        ->orWhere('order_transfers.requested_branch_id', '=', $branchId);
                }
            )
            ->select('orders.serial_number as serial_number', 'orders.item as item', 'orders.customer_name as customer_name', 'orders.created_date as created_date')
            ->get();

        $stuckOrderCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('orders.working_status', '=', 'Stuck')
            ->where(
                function ($query) use ($branchId) {
                    return $query
                        ->where('order_transfers.approved_branch_id', '=', $branchId)
                        ->orWhere('order_transfers.requested_branch_id', '=', $branchId);
                }
            )
            ->count();

        return response()->json(['stuckOrder' => $stuckOrder, 'stuckOrderCount' => $stuckOrderCount]);
    }

    public function createdOrder(Request $request)
    {
        $branchName =   Branch::where('id', '=', Auth::user()->branch_id)->value('name');

        $request->validate([
            'serial_number' => 'required|unique:orders',
        ]);

        $newOrder = new Order;

        $newOrder->serial_number = $request->input('serial_number');
        $newOrder->customer_name = $request->input('customer_name');
        $newOrder->mobile = $request->input('mobile');
        $newOrder->Item = $request->input('Item');
        $newOrder->weight = $request->input('weight');
        $newOrder->total_amount = $request->input('total_amount');
        $newOrder->paid_amount = $request->input('paid_amount');
        $newOrder->payment_mode = $request->input('payment_mode');
        $newOrder->created_date = $request->input('created_date');
        $newOrder->due_date = $request->input('due_date');
        $newOrder->created_branch_id = Auth::user()->branch_id;
        $newOrder->created_user_id =  Auth::user()->id;
        $newOrder->current_location =  $branchName;
        $newOrder->address = $request->input('address');
        $newOrder->img = $request->input('img');
        $newOrder->working_status = "NotStart";
        $newOrder->save();

        return response()->json(["messages" => "Successfully created order"]);
    }
}

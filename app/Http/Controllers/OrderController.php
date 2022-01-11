<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Branch;
use App\Models\User;
use App\Models\Location;
use Carbon\Carbon;
use StdClass;

class OrderController extends Controller
{
    public function completedOrder(Request $request)
    {
        $branch_status = $request->branch_status;
        $working_status = $request->working_status;

        if ($request->input("from")) {
            $from = $request->from;
        } else {
            $from = "";
        }
        if ($request->input("to")) {
            $to = $request->input("to");
        } else {
            $to = "";
        }


        $completedOrders = Order::leftjoin('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->join('users', 'orders.created_user_id', '=', 'users.id')
            ->join('branches', 'orders.created_branch_id', '=', 'branches.id')
            ->where(
                function ($query)  {
                    return $query
                        ->where('orders.working_status', '=', 'Completed')
                        ->orWhere('orders.working_status', '=', 'Stuck');
                }
            )
            ->orderBy('orders.id');

        if (($from != "") && ($to != "")) {
            $completedOrders =    $completedOrders->whereBetween('orders.created_date', [$from, $to]);
        } elseif($from != "" && $to == "") {
            $completedOrders =    $completedOrders->whereDate('orders.created_date',$from);
        }else{
            $completedOrders =    $completedOrders->whereDate('orders.created_date',Carbon::now()->toDateString());
        }

        if ($branch_status != "") {
            $completedOrders =   $completedOrders->where('orders.created_branch_id', '=', $branch_status);
        }
        if ($working_status != "") {
            $completedOrders =   $completedOrders->where('orders.working_status', '=', $working_status);
        }

        $completedOrders =  $completedOrders->orderBy('orders.id', 'desc')
            ->select('orders.id as Oid', 'users.id as Uid', 'branches.id as Bid', 'order_transfers.Id as OTid', 'orders.*', 'order_transfers.*', 'branches.name as branchName')
            ->paginate(10);

        $branches =  Branch::get();

        $users = User::get();
        $locations = Location::get();

        return view('order.completedOrder')
            ->with('completedOrders', $completedOrders)
            ->with('branches', $branches)
            ->with('users', $users)
            ->with('locations', $locations)
            ->with('from', $from)
            ->with('to', $to)
            ->with('working_status', $working_status)
            ->with('branch_status', $branch_status);
    }

    public function pendingOrder(Request $request)
    {

        $branch_status = $request->branch_status;
        $location_status = $request->location_status;

        $pendingOrders = Order::leftjoin('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->join('users', 'orders.created_user_id', '=', 'users.id')
            ->join('branches', 'orders.created_branch_id', '=', 'branches.id')
            ->where(
                function ($query)  {
                    return $query
                        ->where('orders.working_status', '=', 'InProgress')
                        ->orWhere('orders.working_status', '=', 'NotStart');
                }
            )
            ->orderBy('orders.id');

        if ($branch_status != "") {
            $pendingOrders =   $pendingOrders->where('orders.created_branch_id', '=', $branch_status);
        }
        if ($location_status != "") {
            $pendingOrders =   $pendingOrders->where('orders.working_status', '=', $location_status);
        }

        $pendingOrders =  $pendingOrders->orderBy('orders.id', 'desc')
            ->select('orders.id as Oid', 'users.id as Uid', 'branches.id as Bid', 'order_transfers.Id as OTid', 'orders.*', 'order_transfers.*', 'branches.name as branchName')
            ->paginate(20);

        $branches =  Branch::get();

        $users = User::get();
        $locations = Location::get();

        return view('order.pendingOrder')
            ->with('pendingOrders', $pendingOrders)
            ->with('branches', $branches)
            ->with('users', $users)
            ->with('locations', $locations)
            ->with('branch_status', $branch_status)
            ->with('location_status', $location_status);
    }

    public function viewOrder(Request $request)
    {

        $order_id = $request->order_id;

        $viewOrder = Order::leftjoin('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('orders.id', $order_id)
            ->select('orders.id as Oid', 'orders.*', 'order_transfers.*')
            ->first();

        $created_branch_name =  Branch::where('id',  $viewOrder->created_branch_id)->value('name');
        $requested_branch_name =  Branch::where('id',  $viewOrder->requested_branch_id)->value('name');
        $approved_branch_name =  Branch::where('id',  $viewOrder->approved_branch_id)->value('name');

        $created_user_name =  User::where('id',  $viewOrder->created_user_id)->value('first_name');
        $requested_user_name =  User::where('id',  $viewOrder->requested_user_id)->value('first_name');
        $approved_user_name =  User::where('id',  $viewOrder->approved_user_id)->value('first_name');

        $viewOrder->created_branch_name = $created_branch_name;
        $viewOrder->requested_branch_name = $requested_branch_name;
        $viewOrder->approved_branch_name = $approved_branch_name;
        $viewOrder->created_user_name = $created_user_name;
        $viewOrder->requested_user_name = $requested_user_name;
        $viewOrder->approved_user_name = $approved_user_name;

        return json_encode($viewOrder);
    }

    public function changeWorking(Request $request)
    {

        $working_status = $request->working_status;
        $order_id = $request->order_id;

        Order::where('id', $order_id)->update(['working_status' =>  $working_status]);
    }
}

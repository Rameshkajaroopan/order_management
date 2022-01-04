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
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)

    {

        $branchId = Auth::user()->branch_id;

        $createdOrderCount = Order::where('created_branch_id', '=', $branchId)
            ->where('working_status', '=', 'NotStart')
            ->count();

        $sendingOrderCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.requested_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        $notificationOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('order_transfers.request_status', '=', 'NotApproved')
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        // $receivedOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
        //     ->where('order_transfers.approved_branch_id', '=', $branchId)
        //     ->where('order_transfers.request_status', '=', 'Approved')
        //     ->count();

        $receivedNotCompletedOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        // $receivedCompletedOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
        //     ->where('order_transfers.approved_branch_id', '=', $branchId)
        //     ->where('orders.working_status', '=', 'Completed')
        //     ->count();

        $stuckOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('orders.working_status', '=', 'Stuck')
            ->where(
                function ($query) use ($branchId) {
                    return $query
                        ->where('order_transfers.approved_branch_id', '=', $branchId)
                        ->orWhere('order_transfers.requested_branch_id', '=', $branchId);
                }
            )
            ->count();

        return response()->json([
            'createdOrderCount' => $createdOrderCount,
            'sendingOrderCount' => $sendingOrderCount,
            'notificationOrder' => $notificationOrder,
            'receivedNotCompletedOrder' => $receivedNotCompletedOrder,
            'stuckOrder' => $stuckOrder
        ]);
    }
}

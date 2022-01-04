<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Branch;
use App\Models\User;

class OrderController extends Controller
{
    public function completedOrder()
    {
        $completedOrders = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->join('users', 'orders.created_user_id', '=', 'users.id')
            ->join('branch', 'orders.created_branch_id', '=', 'branch.id')
            ->where('orders.working_status', '=', 'completed')
            ->get();

        $branches =  Branch::get();
        $users = User::get();

        return view('order.completedOrder')
            ->with('completedOrders', $completedOrders)
            ->with('branches', $branches)
            ->with('users', $users);
    }

    public function pendingOrder()
    {
        $pendingOrders = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->join('users', 'orders.created_user_id', '=', 'users.id')
            ->join('branch', 'orders.created_branch_id', '=', 'branch.id')
            ->where('orders.working_status', '!=', 'completed')
            ->get();

        $branches =  Branch::get();
        $users = User::get();

        return view('order.pendingOrder')
        ->with('completedOrders', $pendingOrders)
        ->with('branches', $branches)
        ->with('users', $users);
    }
}

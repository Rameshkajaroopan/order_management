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

        $totalCount = Order::where('created_branch_id', '=', $branchId)
            ->count();

        $NewCount = Order::where('created_branch_id', '=', $branchId)
            ->where('working_status', '=', 'NotStart')
            ->count();

        $sentCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.requested_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        $notificationOrder = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('order_transfers.request_status', '=', 'NotApproved')
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        $receivedCount = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->count();

        // today 
        $totalCountToday = Order::where('created_branch_id', '=', $branchId)
            ->whereDate('created_date', Carbon::now()->toDateString())
            ->count();

        $NewCountToday = Order::where('created_branch_id', '=', $branchId)
            ->where('working_status', '=', 'NotStart')
            ->whereDate('created_date', Carbon::now()->toDateString())
            ->count();

        $sentCountToday = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.requested_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->whereDate('order_transfers.requested_date', Carbon::now()->toDateString())
            ->count();


        $receivedCountToday = Order::join('order_transfers', 'orders.id', '=', 'order_transfers.order_id')
            ->where('order_transfers.approved_branch_id', '=', $branchId)
            ->where('orders.working_status', '=', 'InProgress')
            ->whereDate('order_transfers.requested_date', Carbon::now()->toDateString())
            ->count();

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

        $totalIncomeToday = Order::where('created_branch_id', '=', $branchId)
            ->whereDate('created_date', Carbon::now()->toDateString())
            ->where('working_status', '!=', 'Cancel')
            ->sum('total_amount');

        $totalPaidToday = Order::where('created_branch_id', '=', $branchId)
            ->where('working_status', '=', 'NotStart')
            ->whereDate('created_date', Carbon::now()->toDateString())
            ->where('working_status', '!=', 'Cancel')
            ->sum('paid_amount');

        $totalCashToday = Order::where('created_branch_id', '=', $branchId)
            ->whereDate('created_date', Carbon::now()->toDateString())
            ->where('working_status', '!=', 'Cancel')
            ->where('payment_mode', '=', 'Cash')
            ->count();

        $totalCardToday = Order::where('created_branch_id', '=', $branchId)
            ->whereDate('created_date', Carbon::now()->toDateString())
            ->where('working_status', '!=', 'Cancel')
            ->where('payment_mode', '=', 'Card')
            ->count();    


        return response()->json([
            'NewCount' => $NewCount,
            'sentCount' => $sentCount,
            'notificationOrder' => $notificationOrder,
            'receivedCount' => $receivedCount,
            'totalCount' => $totalCount,
            'totalIncomeToday' => $totalIncomeToday,
            'totalPaidToday' => $totalPaidToday,
            'totalCashToday' => $totalCashToday,
            'totalCardToday' => $totalCardToday
        ]);
    }

    public function profile()
    {
        // $loginUser = Auth::user();
        $userId = Auth::user()->id;

        $loginUser = User::join('branches','branches.id','=','users.branch_id')
        ->join('locations','locations.id','=','branches.location_id')
        ->where('users.id', $userId)
        ->select('users.first_name as username','branches.name as branchname','locations.name as locationname','users.role as role')
        ->first();
        
        return response()->json(['loginUser' => $loginUser]);
    }
}

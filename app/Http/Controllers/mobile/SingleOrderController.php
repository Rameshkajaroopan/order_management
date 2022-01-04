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

       $orderId =  Order::where('serial_number' ,'=', $serial_number)->value('id');
       $singleOrderTransferId = OrderTransfer::where('order_id' ,'=', $orderId)->value('id');

       $singleOrder = Order::find($orderId);
       $singleOrderTransfer = OrderTransfer::find($singleOrderTransferId);
       $users =  User::all();
       $branches = Branch::all();    
       $locations = Location::all();    

       return response()->json(['singleOrder' => $singleOrder, 'singleOrderTransfer' => $singleOrderTransfer, 'users' => $users, 'branches' => $branches,'locations' => $locations , 'order_page' => $order_page ]);
    }
    
}

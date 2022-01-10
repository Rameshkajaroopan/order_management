<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {



        $orders = Order::orderBy('id', 'desc')->take(5)->get();
        $allorders = Order::all();
        $total_amount = Order::whereDate('created_date',Carbon::now())->sum('total_amount');
        $total_paid = Order::whereDate('created_date',Carbon::now())->sum('paid_amount');
        
        return view('home')->with('orders',$orders)->with('allorders',$allorders)->with('total',$total_amount)->with('paid',$total_paid);
    }
}

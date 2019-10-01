<?php

namespace App\Http\Controllers\Admin\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\DB;

class DateRangeOrderController extends Controller
{
    public function orderRange()
    {
        DB::enableQueryLog(); // Enable query log

        $startDate = $_GET['startDate'];
        $endDate = $_GET['endDate'];
        //Eager Loading
        // $orders = Order::with('payment', 'employee', 'table')
        //                 ->whereBetween(DB::raw('DATE(created_at)'), array($startDate, $endDate))
        //                 ->orderBy('created_at', 'desc')
        //                 ->get()
        //                 ->groupBy(function ($order) {
        //                     return $order->created_at->format('M-y');
        //                 });

        $orders = Order::join('payments', 'orders.id', '=', 'payments.order_id')
                    ->join('users', 'orders.employee_id', '=', 'users.id')
                    ->join('tables', 'orders.table_id', '=', 'tables.id')
                    ->select('orders.*', 'payments.gross_price', 'users.name', 'tables.table_no')
                    ->whereBetween(DB::raw('DATE(tbl_orders.created_at)'), [$startDate, $endDate])
                    ->orderBy('orders.created_at', 'desc')
                    ->get()
                    ->groupBy(function ($order) {
                        return $order->created_at->format('M-y');
                    });
        // dd(DB::getQueryLog());
        // dd($orders);
        return response()->json($orders);
    }
}

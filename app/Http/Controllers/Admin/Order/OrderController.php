<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Admin\TablesController;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Models\Admin\Category;
use App\Models\Admin\Payment;
use App\Models\Admin\Table;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all()->sortByDesc('created_at')->groupBy(function ($order) {
            return $order->created_at->format('M-y');
        });
        // dd($orders);
        return view('admin.orders.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tables = Table::where('status', Table::VACANT)->get();
        $parentCategories = Category::where('parent_id', null)->get();
        
        return view('admin.orders.create')->with('tables', $tables)
                                            ->with('parentCategories', $parentCategories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateOrderRequest $request)
    {
        $order = Order::create([
            'employee_id' => Auth::user()->id,
            'table_id' => (int)$request->tableId,
            ]);

        $tableStatus = new TablesController();
        $tableStatus->updateTableStatus($request->tableId);
        
        //storing data into pivot table
        foreach ($request->dishList as $dishInfo) {
            $order->products()->attach((int) $dishInfo['dishId'], ['quantity' => (int) $dishInfo['quantity']]);
        }
        
        $payment = Payment::create([
            'order_id' => $order->id,
            'net_price' => $request->netPrice,
            'gross_price' => $request->grossPrice,
            'vat' => $request->vat,
        ]);
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return 1;
    }
}

@extends('layouts.admin')
@section('title', 'All Orders')

@section('content')
<div class="input-group date">
    <input type="text" class="form-control depart-date" id="depart-date" name="date_of_depart">
</div>
    @foreach ($orders as $key => $monthOrders)
        <div class="box">
            <div class="box-body">
                <h4>{{$key}}</h4>
                <table id="" class="table order-list table-bordered table-hover">
                    <thead>
                        <tr>
                            <th style="width: 10%">Order No.</th>
                            <th>Table</th>
                            <th>Waiter</th>
                            <th>Order Value</th>
                            <th>Status</th>
                            <th>@lang('global.app_action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthOrders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->table->table_no}}</td>
                                <td>{{$order->employee->name}}</td>
                                <td>{{$order->payment->gross_price}}</td>
                                <td>{{$order->status}}</td>
                                <td>
                                    <div class="btn-group">
                                        @if ($order->payment->payment_status)
                                            <a href="" class="btn btn-info" data-toggle="tooltip" title="Details">
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        @else
                                            <a href="" class="btn btn-success" data-toggle="tooltip" title="@lang('global.app_edit')">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <a href="http://restulator.binarycastle.net/print-order/2787" class="btn btn-info" data-toggle="tooltip" title="Print">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger order-delete" data-url="{{route('order.destroy', ['id' => $order->id])}}" data-toggle="tooltip" title="@lang('global.app_delete')">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>    
                </table>
            </div>
        </div>
        {{-- {{ $orders->links() }} --}}
    @endforeach
@endsection
@extends('layouts.admin')
@section('title', 'New Order')

@section('content')
    <div class="box">
        <div class="box-body">
            <form class="form-horizontal" id="orderForm" method="post" role="form" data-parsley-validate="" novalidate="">
                @csrf
                <div class="form-group">
                    <label for="table" class="col-xs-2 control-label">Select Table</label>
                    <div class="col-xs-2">
                        <select name="table" id="table" class="form-control">
                            <option value="">--Select Table--</option>
                            @foreach ($tables as $table)
                                <option value="{{$table->id}}">{{$table->table_no}}</option>
                            @endforeach
                        
                        </select>
                    </div>
                    <label for="dish" class="col-sm-2 control-label">Dish Type<span class="text-danger">*</span></label>
                    <div class="col-sm-4">
                        <select name="dishCategory" id="dishCategory" data-url="" class="form-control">
                            <option value="">--Select dish--</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{$parentCategory->id}}">{{$parentCategory->name}}</option>
                            @endforeach
                        </select>
                        <script type="text/javascript">
                            var productGetUrl = "{{route('category.product.index', 'model')}}";
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <label for="dish" class="col-sm-2 control-label">Select Dish <span class="text-danger">*</span></label>
                    <div class="col-sm-2">
                        <select name="dish" id="dish" class="form-control">
                            <option value="">--Select One--</option>
                        </select>
                    </div>
                    <label for="quantity" class="col-sm-1 control-label">Quantity</label>
                    <div class="col-sm-1">
                        <input type="number" min="1" max="100" value="1" class="form-control" id="quantity" placeholder="Quantity">
                    </div>
                    <label for="price" class="col-sm-1 control-label">Price</label>
                    <div class="col-sm-3">
                        <input type="number" min="1" disabled='' class="form-control" id="price" placeholder="Quantity">
                    </div>
                </div>
    
                <div class="form-group">
    
                </div>
    
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Add Dish
                        </button>
                        <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="box">
        <div class="box-body">
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th style="border: 1px solid black">Dish Name</th>
                    <th width="10%" style="border: 1px solid black">Type</th>
                    <th style="border: 1px solid black">Q</th>
                    <th style="border: 1px solid black">Price (USD)</th>
                    <th width="5%" style="border: 1px solid black">Action</th>
                </tr>
                </thead>
                <tbody id="orderDetails">

                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-horizontal" id="orderSummary">
                        {{-- <div class="form-group">
                            <label class="col-sm-2 control-label">Price inc Vat</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="number" value="37" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Payment</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="number" value="" min="1" onchange="$(this).showChange(35)" onkeyup="$(this).showChange(35)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Change</label>
                            <div class="col-sm-5">
                                <input class="form-control" type="number" value="" id="change_text_field" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button class="btn btn-success ladda-button" onclick="$(this).saveOrder()">Submit Order</button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
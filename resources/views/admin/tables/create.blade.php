@extends('layouts.admin')

@section('title', 'Add Table')
@section('page-title', 'Table')
@section('page-sub-title','Add')

@section('content')
    
    <!--Table Create Box Starts Here-->
    <div class="box box-primary">
        <div class="container">
            <div class="box-header">
                <a href="{{route('table.index')}}" class="btn btn-success pull-right">@lang('global.app_all') @lang('global.table-mgmt.title')</a>
            </div>
            <div class="box-body">
                <!--Form Start-->
                <form action="{{route('table.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="table_no">@lang('global.table-mgmt.title')</label>
                        <input type="text" id="table_no" name="table_no" class="form-control" placeholder="Table No / Table Name">
                    </div>
                    <div class="form-group">
                        <label for="capacity">@lang('global.table-mgmt.capacity')</label>
                        <input type="text" id="capacity" name="capacity" class="form-control" placeholder="Table Capacity">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div><!--Table Create Form Ends Here-->
@endsection
@extends('layouts.admin')

@section('title', 'Edit Table')
@section('page-title', 'Table')
@section('page-sub-title','Edit')

@section('content')
    
    <!--Table Edit Box Starts Here-->
    <div class="box box-primary">
        <div class="container">
            <div class="box-header">
                @can('table-view')
                    <a href="{{route('table.index')}}" class="btn btn-success pull-right">@lang('global.app_all') @lang('global.table-mgmt.title')</a>
                @endcan
                @can('table-add')
                    <a href="{{route('table.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>&nbsp;&nbsp;@lang('global.app_new')</a>
                @endcan
            </div>
            <div class="box-body">
                <!--Form Start-->
                <form action="{{route('table.update', ['id' => $table->id])}}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="table_no">@lang('global.table-mgmt.title')</label>
                        <input type="text" id="table_no" name="table_no" class="form-control" value="{{$table->table_no}}" placeholder="Table No / Table Name">
                    </div>
                    <div class="form-group">
                        <label for="capacity">@lang('global.table-mgmt.capacity')</label>
                        <input type="text" id="capacity" name="capacity" class="form-control" value="{{$table->capacity}}" placeholder="Table Capacity">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div><!--Table Edit Form Ends Here-->
@endsection
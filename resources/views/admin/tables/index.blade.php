@extends('layouts.admin')

@section('title', 'Table Management')
@section('page-title', 'Table Management')

@section('content')
    <div class="box">
        <div class="box-header">
            @can('table-add')
                <a href="{{route('table.create')}}" class="btn btn-success pull-right"><i class="fas fa-plus"></i>&nbsp;&nbsp;@lang('global.app_new')</a>
            @endcan
        </div>
        <div class="box-body">
            <table id="dataList" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>@lang('global.app_id')</th>
                        <th>@lang('global.table-mgmt.table_no')</th>
                        <th>@lang('global.table-mgmt.capacity')</th>
                        <th>@lang('global.app_status')</th>
                        @can('table-action')
                            <th>@lang('global.app_action')</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @if ($tables->count() > 0)
                        @php($count = 1)
                        @foreach ($tables as $table)
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{$table->table_no}}</td>
                                <td>{{$table->capacity}}</td>
                                <td>
                                    @if ($table->status == 0)
                                        <p class="text-success font-bold"><i class="fas fa-circle text-green"></i>&nbsp;&nbsp;@lang('global.table-mgmt.vacant')</p>
                                    @else
                                        <p class="text-danger"><i class="fas fa-circle text-red"></i>&nbsp;&nbsp;@lang('global.table-mgmt.booked')</p>
                                    @endif
                                </td>
                                @can('table-action')
                                    <td class="action">
                                        @can('table-edit')
                                            <a href="{{route('table.edit', ['id' => $table->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('table-delete')
                                            <form action="{{route('table.destroy', ['id' => $table->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" data-toggle="tooltip" title="@lang('global.app_trash')" class="btn btn-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="5" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
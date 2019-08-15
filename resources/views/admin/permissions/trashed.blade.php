@extends('layouts.admin')

@section('title', 'Trashed Permissions')
@section('page-title', 'Permissions')
@section('page-sub-title','Trashed')

@section('content')
    <div class="box">
        <div class="box-header">
            @lang('global.app_trashed') @lang('global.permission.title')
            {{-- <a href="{{route('permission.create')}}" class="btn btn-success float-right">Add New</a> --}}
            {{-- <a href="{{route('permission.trashed')}}" class="btn btn-danger float-right">Trashed</a> --}}
        </div>
        <div class="box-body">
            <table id="dataList" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>@lang('global.permission.title')</th>
                        <th>@lang('global.permission_component.title')</th>
                        <th>@lang('global.app_created_at')</th>
                        <th>@lang('global.app_deleted_at')</th>
                        <th>@lang('global.app_action')</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($permissions->count() > 0)
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{$permission->permission}}</td>
                                <td>{{$permission->component->component}}</td>
                                <td>{{$permission->created_at}}</td>
                                <td>{{$permission->deleted_at}}</td>
                                <td class="action">
                                    <form action="{{route('permission.restore', ['id' => $permission->id])}}" method="get" class="form-restore">
                                        @csrf
                                        <button type="submit" data-toggle="tooltip" title="@lang('global.app_restore')" class="btn btn-info btn-sm">
                                            <i class="fas fa-window-restore"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('permission.kill', ['id' => $permission->id])}}" method="get">
                                        @csrf
                                        <button type="submit" data-toggle="tooltip" title="@lang('global.app_delete') @lang('global.app_permanently')" class="btn btn-danger btn-sm">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="4" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
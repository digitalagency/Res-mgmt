@extends('layouts.admin')

@section('title', 'Roles')
@section('page-title', 'Roles')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('global.role.title')</h3>
                    @can('role-add')
                        <a href="{{route('role.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
                    @endcan
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="dataList" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>@lang('global.app_id')</th>
                                <th>@lang('global.role.fields.name')</th>
                                <th>@lang('global.app_created_at')</th>
                                @can('role-action')
                                    <th>@lang('global.app_action')</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if ($roles->count() > 0)
                            @php($count  = 1)
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$role->role}}</td>
                                        <td>{{$role->created_at->toFormattedDateString()}}
                                        @can('role-action')
                                            <td class="action">
                                                @can('role-edit')
                                                    <a href="{{route('role.edit', ['id' => $role->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('role-delete')
                                                    <form action="{{route('role.destroy', ['id' => $role->id])}}" method="post" >
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="@lang('global.app_delete')">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endcan
                                    </tr>
                                    @php($count++)
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="4" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->




    {{-- <div class="card">
        <div class="card-header">
            Roles
            @can('event-create')
                <a href="{{route('role.create')}}" class="btn btn-success float-right">Add New</a>
            @endcan
            
        </div>
        <div class="card-body">
             <table id="dataList" class="table table-bordered table-hover table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($roles->count() > 0)
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->role}}</td>
                                <td>
                                    <a href="{{route('role.edit', ['id' => $role->id])}}" class="btn btn-info btn-sm">
                                        Edit
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{route('role.destroy', ['id' => $role->id])}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th colspan="3" class="text-center font-italic">No Roles!!!</th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div> --}}
@endsection
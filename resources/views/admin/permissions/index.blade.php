@extends('layouts.admin')

@section('title', 'Permissions')
@section('page-title', 'Permissions')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('global.permission.title')</h3>
                    @can('permission-add')
                        <a href="{{route('permission.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
                    @endcan
                    @can('permission-delete')
                        <a href="{{route('permission.trashed')}}" class="btn btn-danger pull-right">@lang('global.app_trashed')</a>
                    @endcan
                </div>
                <div class="box-body">
                    <div class="row">
                        @foreach ($p_components as $p_component)
                            <div class="col-md-6 col-sm-12">
                                <h4 class="component-title">{{$p_component->component}} @lang('global.permission.title')</h4>
                                <table id="" class="table table-bordered table-hover table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>@lang('global.app_id')</th>
                                            <th>@lang('global.permission.title')</th>
                                            <th>@lang('global.app_created_at')</th>
                                            @can('permission-action')
                                                <th>@lang('global.app_action')</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($permissions->count() > 0)
                                            @php($count = 1)
                                            @foreach ($permissions as $permission)
                                                @if ($p_component->id == $permission->p_component_id)
                                                    <tr>
                                                        <td>{{$count}}</td>
                                                        <td>{{$permission->permission}}</td>
                                                        <td>{{$permission->created_at}}</td>
                                                        @can('permission-action')
                                                            <td class="action">
                                                                @can('permission-edit')
                                                                    <a href="{{route('permission.edit', ['id' => $permission->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
                                                                        <i class="far fa-edit"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('permission-delete')
                                                                    <form action="{{route('permission.destroy', ['id' => $permission->id])}}" method="post">
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
                                                    @php($count++)
                                                @endif
                                                
                                            @endforeach
                                        @else
                                            <tr>
                                                <th colspan="4" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                    {{-- <table id="" class="table table-bordered table-hover table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>@lang('global.permission.title')</th>
                                <th>@lang('global.permission_component.fields.component')</th>
                                <th>@lang('global.app_created_at')</th>
                                <th>@lang('global.app_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($permissions->count() > 0)
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->permission}}</td>
                                        <td>{{$permission->component->component}}</td>
                                        <td>{{$permission->created_at->toFormattedDateString()}}</td>
                                        <td class="action">
                                            <a href="{{route('permission.edit', ['id' => $permission->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <form action="{{route('permission.destroy', ['id' => $permission->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" data-toggle="tooltip" title="@lang('global.app_trash')" class="btn btn-danger btn-sm">
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
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
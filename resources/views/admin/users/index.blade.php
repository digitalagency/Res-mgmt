@extends('layouts.admin')

@section('title', 'Employees')
@section('page-title', 'Employees')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title>">@lang('global.employee.title')</h3>
            @can('employee-add')
                <a href="{{route('employee.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
            @endcan
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>@lang('global.employee.fields.name')</th>
                        <th>@lang('global.employee.fields.email')</th>
                        <th>@lang('global.employee.fields.image')</th>
                        <th>@lang('global.role.fields.name')</th>
                        <th>@lang('global.app_created_at')</th>
                        @can('employee-action')
                            <th>@lang('global.app_action')</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @if ($users->count() > 0)
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <!-- retrieves the images from database and displays in the index page -->
                                <td><img src="{{ asset('images')}}/{{ $user->image }}" style="height: 70%; width: 70%;"></td>
                               <td>{{$user->role->role}}</td>
                                <td>{{$user->created_at->toFormattedDateString()}}</td>

                                <!-- checks if the user have access to action or not -->
                                @can('employee-action')
                                    <td class="action">

                                        <!-- directs to different page if the user have access to edit the employees -->
                                        @can('employee-edit')
                                            <a href="{{route('employee.edit', ['id' => $user->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                        @endcan

                                        <!-- deleted the stored data if the user have access to delete the information of employee -->
                                        @can('employee-delete')
                                            <form action="{{route('employee.destroy', ['id' => $user->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" data-toggle="tooltip" title="@lang('global.app_delete')" class="btn btn-danger btn-sm">
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
                            <th colspan="3" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('title', 'Permission Components')
@section('page-title', 'Permission Components')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('global.permission_component.title')</h3>
                    <a href="{{route('p_component.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
                </div>
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>@lang('global.app_id')</th>
                                <th>@lang('global.permission_component.fields.component')</th>
                                <th>@lang('global.app_action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($components->count() > 0)
                                @php ($count = 1)
                                @foreach ($components as $component)
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>{{$component->component}}</td>
                                        <td class="action">
                                            <a href="{{route('p_component.edit', ['id' => $component->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <form action="{{route('p_component.destroy', ['id' => $component->id])}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" data-toggle="tooltip" title="@lang('global.app_delete')" class="btn btn-danger btn-sm">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php ($count++)
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="3" class="text-center font-italic"><i>@lang('global.app_no_entries_in_table')</i></th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
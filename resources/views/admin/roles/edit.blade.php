@extends('layouts.admin')

@section('title', 'Edit Role')
@section('page-title', 'Role')
@section('page-sub-title','Edit')

@section('content')
    <!--Role Edit Box Starts Here-->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('global.app_edit'): {{$role->role}}
        </div>
        <div class="box-body">
            <!--Form Starts-->
            <form action="{{route('role.update', ['id' => $role->id])}}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="role">@lang('global.role.fields.name')</label>
                    <input type="text" name="role" id="role" value="{{$role->role}}" class="form-control">
                </div>
                <div class="row">
                    @foreach ($p_components as $component)
                        <div class="col-md-4">
                            <label for="">{{$component->component}} @lang('global.permission.title')</label>
                            @foreach ($permissions as $permission)
                                @if ($permission->p_component_id == $component->id)
                                    <div class='checkbox'>
                                        <!--Put Checked Attibute to input if the user has that permission-->
                                        <label for=""><input type='checkbox' name="permission[]" value="{{$permission->id}}"
                                            @foreach ($role->permissions as $role_permit)
                                                @if ($role_permit->id == $permission->id)
                                                    {{'checked'}}
                                                @endif
                                            @endforeach
                                            >{{$permission->permission}}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">@lang('global.app_update')</button>
                </div>
            </form>
        </div>
    </div>
    <!--Role Edit Box Ends Here-->
@endsection
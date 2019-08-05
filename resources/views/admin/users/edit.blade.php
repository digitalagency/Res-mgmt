@extends('layouts.admin')


@section('content')
    <!--Edit Box Starts Here-->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('global.app_edit') @lang('global.employee.title1'): {{$user->name}}</h3>
        </div>
        <div class="box-body">
            <form action="{{route('employee.update', ['id' => $user->id])}}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">@lang('global.employee.fields.name')</label>
                    <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">@lang('global.employee.fields.email')</label>
                    <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">@lang('global.role.fields.name')</label>
                    <select name="role" id="role" class="form-control">
                        <!--Show Assigned Role at First then remaining roles-->
                        @foreach ($roles as $role)
                            <option value="{{$user->role_id}}">{{$user->role->role}}</option>
                            @if ($user->role_id != $role->id)
                                <option value="{{$role->id}}">{{$role->role}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
                </div>
            </form>
        </div>
    </div><!--Edit Box Ends Here-->
@endsection
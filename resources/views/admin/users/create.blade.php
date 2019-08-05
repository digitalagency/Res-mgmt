@extends('layouts.admin')


@section('content')
    <!--Create User Box Starts Here-->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('global.app_create') @lang('global.employee.title1')</h3>
        </div>
        <div class="box-body">
            <!--Form Starts Here-->
            <form action="{{route('employee.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">@lang('global.employee.fields.name')</label>
                    <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">@lang('global.employee.fields.email')</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">@lang('global.employee.fields.password')</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="role">@lang('global.role.fields.name')</label>
                    <select name="role" id="role" class="form-control">
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->role}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
                </div>
            </form><!--Form Ends-->
        </div>
    </div><!--Create User Box Ends Here-->
@endsection
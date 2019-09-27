@extends('layouts.admin')

@section('title', 'Edit Employee')
@section('page-title', 'Employee')
@section('page-sub-title','Edit')

@section('content')
    <!--Edit Box Starts Here-->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('global.app_edit') @lang('global.employee.title1'): {{$user->name}}</h3>
        </div>
        <div class="box-body">
            <form action="{{route('employee.update', ['id' => $user->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">@lang('global.employee.fields.name')</label>
                    <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">@lang('global.employee.fields.email')</label>
                    <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control">

                    <!-- displays error message when the entered email address is not valid -->
                    @erorr('email')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="role">@lang('global.role.fields.name')</label>
                    <select name="role_id" id="role_id" class="form-control">
                        <!--Show Assigned Role at First then remaining roles-->
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->role}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- additional requirements for employees -->

                <div class="form-group">
                    <label for="description">@lang('global.employee.fields.description')</label>
                    <textarea id="description" class="form-control" type="description" name="description" style="width: 100%; height: 200px;">{{$user->description}}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="facebook">@lang('global.employee.fields.facebook')</label>
                    <input type="text" name="facebook" id="facebook" class="form-control" value="{{$user->facebook}}">
                </div>
               <!--  condition: true ? false -->
                <div class="form-group">
                    <label for="instagram">@lang('global.employee.fields.instagram')</label>
                    <input type="text" name="instagram" id="instagram" class="form-control" value="{{$user->instagram}}">
                </div>
                <div class="form-group">
                    <label for="twitter">@lang('global.employee.fields.twitter')</label>
                    <input type="text" name="twitter" id="twitter" class="form-control" value="{{$user->twitter}}">
                </div>
                <div class="form-group">
                    <label for="address">@lang('global.employee.fields.address')</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{$user->address}}">
                </div>
                <div class="form-group">
                    <label>@lang('global.employee.fields.oldImage')</label>
                    <img src="{{ asset('images')}}/{{ $user->image }}" style="height: 20%; width: 20%;" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image">@lang('global.employee.fields.newImage')</label>
                    <input type="file" name="image" id="image" class="form-control" value="{{$user->image}}">
                </div>
                 
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
                </div>
            </form>
        </div>
    </div><!--Edit Box Ends Here-->
@endsection
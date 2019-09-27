@extends('layouts.admin')

@section('title', 'Employee')
@section('page-title', 'Employee')
@section('page-sub-title','Create')

@section('content')
    <!--Create User Box Starts Here-->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">@lang('global.app_create') @lang('global.employee.title1')</h3>
        </div>
        <div class="box-body">
            <!--Form Starts Here-->
            <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">@lang('global.employee.fields.name')</label>
                    <input type="text" id="name" name="name" class="form-control">

                    <!-- to generate error message if the requirement isn't met -->
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger" >
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">@lang('global.employee.fields.email')</label>
                    <input type="email" name="email" id="email" class="form-control">

                    <!-- generates error message if the entered email address is not valid -->
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="password">@lang('global.employee.fields.password')</label>
                    <input type="password" name="password" id="password" class="form-control">

                    <!-- displays error message if the password doesn't meet requirement -->
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
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
                    <label for="description">@lang('global.employee.fields.description')</label>
                    <textarea id="description" class="form-control" type="description" name="description" style="width: 100%; height: 200px;"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="facebook">@lang('global.employee.fields.facebook')</label>
                    <input type="text" name="facebook" id="facebook" class="form-control">

                    @error('facebook')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
                </div>
               <!--  condition: true ? false -->
                <div class="form-group">
                    <label for="instagram">@lang('global.employee.fields.instagram')</label>
                    <input type="text" name="instagram" id="instagram" class="form-control">

                    @error('instagram')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="twitter">@lang('global.employee.fields.twitter')</label>
                    <input type="text" name="twitter" id="twitter" class="form-control">

                    @error('twitter')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">@lang('global.employee.fields.address')</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image">@lang('global.employee.fields.image')</label>
                    <input type="file" name="image" id="image" class="form-control">

                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">
                                {{$message}}
                            </strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
                </div>
            </form><!--Form Ends-->
        </div>
    </div><!--Create User Box Ends Here-->
@endsection
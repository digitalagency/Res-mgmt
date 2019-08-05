@extends('layouts.admin')


@section('content')
    <!--Permission Create Box Starts Here-->
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">@lang('global.app_create') @lang('global.permission.title')</h3>
        </div>
        <div class="box-body">
            <!--Form Start-->
            <form action="{{route('permission.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="permission">@lang('global.permission.title')</label>
                    <input type="text" id="permission" name="permission" class="form-control">
                </div>
                <div class="form-group">
                    <label>@lang('global.permission_component.title')</label>
                    <select class="form-control" name="component">
                        @foreach ($p_components as $component)
                            <option value="{{$component->id}}">{{$component->component}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
                </div>
            </form>
        </div>
    </div><!--Permission Create Form Ends Here-->
@endsection
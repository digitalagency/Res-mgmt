@extends('layouts.admin')

@section('content')
        <!--Permission Component Edit Box Starts Here-->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">@lang('global.app_edit') {{$p_component->component}}:</h3>
            </div>
            <!--form start-->
            <form action="{{route('p_component.update', ['id' => $p_component->id])}}" method="post" role="form" class="">
                @csrf
                @method('put')
                <div class="box-body">
                    <div class="form-group">
                        <label for="component">@lang('global.permission_component.fields.component')</label>
                        <input type="text" name="component" id="component" value="{{$p_component->component}}" class="form-control">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">@lang('global.app_update')</button>
                </div>
            </form>
        </div><!--Permission Component Edit Box Ends Here-->
@endsection
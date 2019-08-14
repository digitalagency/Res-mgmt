@extends('layouts.admin')


@section('content')

<div class="box">
	<div class="box-header">
        <h3 class="box-title"> @lang('global.app_create')
        @lang('global.category.title')
        </h3>
    </div>
    <div class="box-body">
    	<form action="{{route('category.store')}}" method="POST">
    		@csrf
    		<div class="form-group">
    			<label for="name">@lang('global.category.field.name')</label>
    			<input type="text" name="name" id="name" class="form-control">
    		</div>
            <div class="form-group">
                <select class="form-control" name="parent_id">
                    <option value="0">--Select parent Categry--</option>
                    <option value="1">Momos</option>
                    <option value="2">
                        Dinner
                    </option>
                </select>
            </div>
        		<div class="form-group">
    			<button type="submit" class="btn btn-success">@lang('global.app_submit')</button>
            </div>
    		
    	</form>
    </div>
</div>
@endsection
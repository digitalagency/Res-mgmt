@extends('layouts.admin')

@section('title', 'Create Category')
@section('content')

<div class="box">
	<div class="box-header">
        <h3 class="box-title"> @lang('global.app_create')@lang('global.category.title')</h3>
    </div>
    <div class="box-body">
    	<form action="{{route('category.store')}}" method="POST">
    		@csrf
    		<div class="form-group">
    			<label for="name">@lang('global.category.field.name')</label>
                <input type="text" name="name" id="name" class="form-control">
                {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    		</div>
            <div class="form-group">
                <select class="form-control" name="parent_id">
                    <option value="">@lang('global.category.field.parent_category')</option>
                    @foreach ($parentCategories as $parentCategory)
                        <option value="{{$parentCategory->id}}">{{$parentCategory->name}}</option>
                    @endforeach
                </select>
            </div>
        		<div class="form-group">
    			<button type="submit" class="btn btn-success">@lang('global.app_submit')</button>
            </div>
    		
    	</form>
    </div>
</div>
@endsection
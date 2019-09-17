@extends('layouts.admin')

@section('title', $category->name)
@section('content')

	<div class="box">
		<div class="box-header">
			<h3 class="box-title">@lang('global.app_edit') @lang('global.category.title')</h3>
			@can('category-add')
                <a href="{{route('category.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
            @endcan
		</div>
		<div class="box-body">
			<form action="{{route('category.update',['id'=>$category->id])}}" method="POST">
				@csrf
				@method('PUT')
				<div class="form-group">
					<label for="name">@lang('global.category.field.name')</label>
					<input type="text" name="name" id="name" value="{{$category->name}}" class="form-control">
					{!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
				</div>
				<div class="form-group">
					<select class="form-control" name="parent_id">
						<option value=''>@lang('global.category.field.parent_category')</option>
						@foreach ($parentCategories as $parentCategory)
							<option value="{{$parentCategory->id}}" {{($category->parent_id==$parentCategory->id) ? 'selected' : ''}}>
								{{$parentCategory->name}}
							</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
				</div>
				
			</form>
			
		</div>
	</div>
@endsection
@extends('layouts.admin')


@section('content')

	<div class="box">
		<div class="box-header">
	        <h3 class="box-title">@lang('global.app_edit') @lang('global.category.title')</h3>
	    </div>
	    <div class="box-body">
	    	<form action="{{route('category.update',['id'=>$category->id])}}" method="POST">
	    		@csrf
	    		@method('PUT')
	    		<div class="form-group">
	    			<label for="name">Name</label>
	    			<input type="text" name="name" id="name" value="{{$category->name}}" class="form-control">
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
	                <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
	            </div>
	    		
	    	</form>
	    	
	    </div>
		
	</div>
@endsection
@extends('layouts.admin')


@section('content')

	<div class="box">
		<div class="box-header">
	        <h3 class="box-title">@lang('global.app_edit') @lang('global.header.title')</h3>
	    </div>
	    <div class="box-body">
	    	<form action="{{route('profileHeader.update',['id'=>$headers->id])}}" method="POST">
	    		@csrf
	    		@method('PUT')
	    		<div class="form-group">
	    			<label for="title">@lang('global.header.fields.title')</label>
	    			<input type="text" name="title" id="title" value="{{$headers->title}}" class="form-control">
	    		</div>
	    		
	    		<div class="form-group">
	    			<label for="contact">@lang('global.header.fields.contact')</label>
	    			<input type="text" name="contact" id="contact" value="{{$headers->contact}}" class="form-control">
	    		</div>

	    		<div class="form-group">
	                <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
	            </div>
	    		
	    	</form>
	    	
	    </div>
		
	</div>
@endsection
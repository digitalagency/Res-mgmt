@extends('layouts.admin')


@section('content')

	<div class="box">
		<div class="box-header">
	        <h3 class="box-title">@lang('global.app_edit') @lang('global.footer.title1')</h3>
	    </div>
	    <div class="box-body">
	    	<form action="{{route('footerFind.update',['id'=>$reserves->id])}}" method="POST">
	    		@csrf
	    		@method('PUT')
	    		<div class="form-group">
	    			<label for="address">@lang('global.footer.fields1.address')</label>
	    			<input type="text" name="address" id="address" value="{{$reserves->address}}" class="form-control">
	    		</div>

	    		<div class="form-group">
	    			<label for="email">@lang('global.footer.fields1.email')</label>
	    			<input type="text" name="email" id="email" value="{{$reserves->email}}" class="form-control">
	    		</div>

	    		<div class="form-group">
	    			<label for="viber">@lang('global.footer.fields1.viber')</label>
	    			<input type="text" name="viber" id="viber" value="{{$reserves->viber}}" class="form-control">
	    		</div>
	    		
	    		<div class="form-group">
	                <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
	            </div>
	    		
	    	</form>
	    	
	    </div>
		
	</div>
@endsection
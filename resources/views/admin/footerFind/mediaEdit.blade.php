@extends('layouts.admin')


@section('content')

	<div class="box">
		<div class="box-header">
	        <h3 class="box-title">Edit Media</h3>
	    </div>
	    <div class="box-body">
	    	<form action="{{route('footerMedia.update',['id'=>$medias->id])}}" method="POST">
	    		
	    		@csrf
	    		@method('PUT')

	    		<div class="form-group">
	    			<label for="facebook">@lang('global.footer.fields3.facebook')</label>
	    			<input type="text" name="facebook" id="facebook" value="{{$medias->facebook}}" class="form-control">
	    		</div>

				<div class="form-group">
	    			<label for="instagram">@lang('global.footer.fields3.instagram')</label>
	    			<input type="text" name="instagram" id="instagram" value="{{$medias->instagram}}" class="form-control">
	    		</div>

	    		<div class="form-group">
	    			<label for="twitter">@lang('global.footer.fields3.twitter')</label>
	    			<input type="text" name="twitter" id="twitter" value="{{$medias->twitter}}" class="form-control">
	    		</div>

	    		<div class="form-group">
	    			<label for="linkedIn">@lang('global.footer.fields3.linkedIn')</label>
	    			<input type="text" name="linkedIn" id="linkedIn" value="{{$medias->linkedIn}}" class="form-control">
	    		</div>

	    		<div class="form-group">
	    			<label for="google">@lang('global.footer.fields3.google')</label>
	    			<input type="text" name="google" id="google" value="{{$medias->google}}" class="form-control">
	    		</div>
	    		
	    		<div class="form-group">
	                <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
	            </div>
	    		
	    	</form>
	    	
	    </div>
		
	</div>
@endsection
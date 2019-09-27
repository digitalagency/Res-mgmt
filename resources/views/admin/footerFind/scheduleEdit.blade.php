@extends('layouts.admin')


@section('content')

	<div class="box">
		<div class="box-header">
	        <h3 class="box-title">@lang('global.app_edit') @lang('global.footer.fieldHeader.schedule')</h3>
	    </div>
	    <div class="box-body">
	    	<form action="{{route('footerSchedule.update',['id'=>$schedule->id])}}" method="POST">
	    		@csrf
	    		@method('PUT')

	    		<div class="form-group">
	    			<label for="close_day">@lang('global.footer.fields2.close')</label>
	    			<input type="text" name="close_day" id="close_day" value="{{$schedule->close_day}}" class="form-control">
	    		</div>

				<div class="form-group">
	    			<label for="open_day_1">@lang('global.footer.fields2.firstOpen')</label>
	    			<input type="text" name="open_day_1" id="open_day_1" value="{{$schedule->open_day_1}}" class="form-control">
	    		</div>

	    		<div class="form-group" id="timeRange">
	    			<label>@lang('global.footer.fields2.firstTime')</label>
	    			<input type="text" name="first_open_from" id="first_open_from" value="{{$schedule->first_open_from}}" class="time start form-control"> to
	    			<input type="text" name="first_open_to" id="first_open_to" value="{{$schedule->first_open_to}}" class="time end form-control">
	    		</div>

	    		<div class="form-group">
	    			<label for="open_day_2">@lang('global.footer.fields2.secondOpen')</label>
	    			<input type="text" name="open_day_2" id="open_day_2" value="{{$schedule->open_day_2}}" class="form-control">
	    		</div>

	    		<div class="form-group" id="timeRange">
	    			<label for="second_open_from">@lang('global.footer.fields2.secondTime')</label>
	    			<input type="text" name="second_open_from" id="second_open_from" value="{{$schedule->second_open_from}}" class="time start form-control">
	    			to
	    			<input type="text" name="second_open_to" id="second_open_to" value="{{$schedule->second_open_to}}" class="time end form-control">
	    		</div>
	    		
	    		<div class="form-group">
	                <button class="btn btn-primary" type="submit">@lang('global.app_submit')</button>
	            </div>
	    		
	    	</form>
	    	
	    </div>
		
	</div>
@endsection
@extends('layouts.admin')


@section('content')

<div class="box">
	<div class="box-header">
        <!-- <h3 class="box-title">Create Header Components Here
        </h3> -->
        @lang('global.app_create')
    </div>
    <div class="box-body">
    	<form action="{{route('profileHeader.store')}}" method="POST">
    		@csrf
    		<div class="form-group">
    			<label for="title">@lang('global.header.fields.title')</label>
    			<input type="text" name="title" id="title" class="form-control">
    		</div>

    		<div class="form-group">
    			<label for="title">@lang('global.header.fields.contact')</label>
    			<input type="text" name="contact" id="contact" class="form-control">
    		</div>

        	<div class="form-group">
    			<button type="submit" class="btn btn-success">@lang('global.app_submit')</button>
            </div>
    		
    	</form>
    </div>
</div>
@endsection
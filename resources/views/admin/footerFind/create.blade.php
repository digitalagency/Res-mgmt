@extends('layouts.admin')


@section('content')
	<div class="box-header">
		<h3 class="box-title">@lang('global.app_create') @lang('global.footer.title')</h3>	
	</div>
	<div id="tabs">
		<ul style="padding-left: 20%;">
			<li><a href="#tabs-1">@lang('global.footer.fieldHeader.reservation')</a></li>
    		<li><a href="#tabs-2">@lang('global.footer.fieldHeader.schedule')</a></li>
    		<li><a href="#tabs-3">@lang('global.footer.fieldHeader.media')</a></li>
  		</ul>

        <div id="tabs-1">
        <!-- Checks if the value sent by HTTP PUT method is set or not. If the value is set, then it opens the form for update otherwise opens the form to create new instance  -->
            @if(isset($reserves->id))
                <form action="{{route('footerFind.update',['id'=>$reserves->id])}}" method="POST">
                @method('PUT')
            @else
                <form action="{{route('footerFind.store')}}" method="POST">
            @endif

                {{ csrf_field() }}
                    <div class="form-group">
    				    <label for="address">@lang('global.footer.fields1.address')</label>
                        <input type="text" name="address" id="address" class="form-control" required autocomplete="address" autofocus value="@if(isset($reserves->id)) {{$reserves->address}} @endif">
                       
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
    				    <label for="">@lang('global.footer.fields1.email')</label>
                        <input type="text" name="email" id="email" class="form-control" required autocomplete="email" autofocus value="@if(isset($reserves->id)) {{$reserves->email}} @endif">
    					
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
    				    <label for="">@lang('global.footer.fields1.viber')</label>
                        <input type="text" name="viber" id="viber" class="form-control" required autocomplete="viber" autofocus value="@if(isset($reserves->id)) {{$reserves->viber}} @endif">
    					
                        @error('viber')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="id" value="{{{ $reserves->id }}}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">@lang('global.app_submit')</button>
                    </div>
                </form>
        </div>

        <div id="tabs-2">

            <form action="{{route('footerSchedule.store')}}" method="POST">

            {{ csrf_field() }}
                <div class="form-group">
                    <label for="close_day">@lang('global.footer.fields2.close')</label>
                    <input type="text" name="close_day" id="close_day" class="form-control" required autocomplete="close_day" autofocus style="width: 40%;">
                        
                    @error('close_day')
                    <span class="invalid-feedback" role="alert">
                        <strong style="color: red;">{{$message}}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">@lang('global.footer.fields2.firstOpen')</label>
                    <input type="text" name="open_day_1" id="open_day_1" class="form-control" required autocomplete="open_day_1" autofocus style="width: 40%;">
                        
                    @error('open_day_1')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group" id="timeRange">
                    <label for="">@lang('global.footer.fields2.firstTime')</label>
                    <!-- <input type="text" class="form-control" name="open_hour_1" id="open_hour_1" required autocomplete="open_hour_1" autofocus> -->
                    <span><input type="text" class="time start form-control" name="first_open_from" required autocomplete="first_open_from" autofocus style="width: 40%" /></span> to 
                    <span><input type="text" class="time end form-control" name="first_open_to" required autocomplete="first_open_to" autofocus style="width: 40%" /></span>

                    @error('open_hour_1')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{$message}}</strong>
                        </span>
                    @enderror
                    
                    
                </div>

                <div class="form-group">
                    <label for="">@lang('global.footer.fields2.secondOpen')</label>
                    <input type="text" name="open_day_2" id="open_day_2" class="form-control" required autocomplete="open_day_2" autofocus style="width: 40%;">

                    @error('open_day_2')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group" id="timeRange">
                    <label for="">@lang('global.footer.fields2.secondTime')</label>
                    <!-- <input type="time" name="open_hour_2" id="open_hour_2" class="form-control" required autocomplete="open_hour_2" autofocus style="width: 40%;"> -->
                    <span><input type="text" class="time start form-control" name="second_open_from" required autocomplete="second_open_from" autofocus style="width: 40%" /></span> to 
                    <span><input type="text" class="time end form-control" name="second_open_to" required autocomplete="second_open_to" autofocus style="width: 40%" /></span>
                        
                    @error('open_hour_2')
                        <span class="invalid-feedback" role="alert">
                            <strong style="color: red;">{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
        		  <button type="submit" class="btn btn-success">@lang('global.app_submit')</button>
                </div>
            </form>
  		
        </div>

  		<div id="tabs-3">
  			<form action="{{route('footerMedia.store')}}" method="POST">
    		@csrf
    			<div class="form-group">
    				<label for="facebook">@lang('global.footer.fields3.facebook')</label>
    				<input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" placeholder="Enter URL" required autocomplete="facebook" autofocus value="{{old('facebook')}}">
                        @error('facebook')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
    			</div>

                <div class="form-group">
                    <label for="instagram">@lang('global.footer.fields3.instagram')</label>
                    <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Enter URL" required autocomplete="instagram" autofocus value="{{old('instagram')}}">
                        @error('instagram')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="twitter">@lang('global.footer.fields3.twitter')</label>
                    <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Enter URL" required autocomplete="twitter" autofocus value="{{old('twitter')}}">
                        @error('twitter')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="linkedIn">@lang('global.footer.fields3.linkedIn')</label>
                    <input type="text" name="linkedIn" id="linkedIn" class="form-control" placeholder="Enter URL" required autocomplete="linkedIn" autofocus value="{{old('linkedIn')}}">
                        @error('linkedIn')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="google">@lang('global.footer.fields3.google')</label>
                    <input type="text" name="google" id="google" class="form-control" placeholder="Enter URL" required autocomplete="google" autofocus value="{{old('google')}}">
                        @error('google')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red;">{{$message}}</strong>
                            </span>
                        @enderror
                </div>

        		<div class="form-group">
        			<button type="submit" class="btn btn-success">@lang('global.app_submit')</button>
            	</div>

    		</form>
  		
        </div>

	</div>
@endsection

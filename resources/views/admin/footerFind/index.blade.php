@extends('layouts.admin')


@section('content')

	<div class="box-header">
		<h3 class="box-title">@lang('global.footer.title')</h3>	
	</div>

	<div id="tabs">
		<ul style="padding-left: 20%;">
			<li><a href="#tabs-1">@lang('global.footer.fieldHeader.reservation')</a></li>
    		<li><a href="#tabs-2">@lang('global.footer.fieldHeader.schedule')</a></li>
    		<li><a href="#tabs-3">@lang('global.footer.fieldHeader.media')</a></li>
  		</ul>

  		<div id="tabs-1">
  			<table id="example1" class="table table-bordered table-striped table-hover">
  				<thead>
  					<tr>
  						<th>@lang('global.footer.fields1.address')</th>
  						<th>@lang('global.footer.fields1.email')</th>
  						<th>@lang('global.footer.fields1.viber')</th>
  						@can('find-reserve-action')
  							<th>@lang('global.app_action')</th>
  						@endcan
  					</tr>
  				</thead>
  				<tbody>
  					@if($reserves->count()>0)
  						@foreach($reserves as $reserve)
  							<tr>
  								<td>{{$reserve->address}}</td>
  								<td>{{$reserve->email}}</td>
  								<td>{{$reserve->viber}}</td>

  								@can('find-reserve-action')
  									<td class="action">
  										@can('find-reserve-edit')
  											<a href="{{route('footerFind.edit',['id'=>$reserve->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
  										@endcan

  										@can('find-reserve-delete')
  											<form action="{{route('footerFind.destroy',['id'=>$reserve->id])}}" method="POST">
  											@csrf
  											@method('DELETE')
  												<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="@lang('global.app_delete')">
                                           		<i class="far fa-trash-alt"></i>
                                            	</button>
  											
  											</form>
  										@endcan
  									
  									</td>
  								@endcan
  							</tr>
  						@endforeach
  					@else
						<tr>
  							<th colspan="3" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
  						</tr>
  						
  					@endif
  				</tbody>
  			</table>
  		</div>
  		<div id="tabs-2">
  			<table id="example1" class="table table-bordered table-striped table-hover">
  				<thead>
  					<tr>
  						<th>@lang('global.footer.fields2.close')</th>
  						<th>@lang('global.footer.fields2.firstOpen')</th>
  						<!-- <th>@lang('global.footer.fields2.firstTime')</th> -->
              <th>Open From</th>
              <th>Open Till</th>
  						<th>@lang('global.footer.fields2.secondOpen')</th>
  						<!-- <th>@lang('global.footer.fields2.secondTime')</th> -->
              <th>Open From</th>
              <th>Open Till</th>
  						@can('schedule-action')
  							<th>@lang('global.app_action')</th>
  						@endcan
  					</tr>
  				</thead>
  				<tbody>
  					@if($schedules->count()>0)
  						@foreach($schedules as $schedule)
  							<tr>
  								<td>{{$schedule->close_day}}</td>
  								<td>{{$schedule->open_day_1}}</td>
  								<td>{{$schedule->first_open_from}}</td>
                  <td>{{$schedule->first_open_to}}</td>
  								<td>{{$schedule->open_day_2}}</td>
  								<td>{{$schedule->second_open_from}}</td>
                  <td>{{$schedule->second_open_to}}</td>

  								@can('schedule-action')
  									<td class="action">
  										@can('schedule-edit')
  											<a href="{{route('footerSchedule.edit',['id'=>$schedule->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
  										@endcan

  										@can('schedule-delete')
  											<form action="{{route('footerSchedule.destroy',['id'=>$schedule->id])}}" method="POST">
  											@csrf
  											@method('DELETE')
  												<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="@lang('global.app_delete')">
                                           		<i class="far fa-trash-alt"></i>
                                            	</button>
  											
  											</form>
  										@endcan
  									</td>
  								@endcan
  							</tr>
  						@endforeach
  					@else
						<tr>
  							<th colspan="3" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
  						</tr>
  						
  					@endif
  				</tbody>
  			</table>
  		</div>
  		<div id="tabs-3">
  			<table id="example1" class="table table-bordered table-striped table-hover">
  				<thead>
  					<tr>
  						<th>@lang('global.footer.fields3.facebook')</th>
  						<th>@lang('global.footer.fields3.instagram')</th>
              <th>@lang('global.footer.fields3.twitter')</th>
              <th>@lang('global.footer.fields3.linkedIn')</th>
              <th>@lang('global.footer.fields3.google')</th>
  						@can('media-action')
  							<th>@lang('global.app_action')</th>
  						@endcan
  					</tr>
  				</thead>
  				<tbody>
  					@if($medias->count()>0)
  						@foreach($medias as $media)
  							<tr>
  								<td>{{$media->facebook}}</td>
  								<td>{{$media->instagram}}</td>
                  <td>{{$media->twitter}}</td>
                  <td>{{$media->linkedIn}}</td>
                  <td>{{$media->google}}</td>
  								@can('media-action')
  									<td class="action">
  										@can('media-edit')
  											<a href="{{route('footerMedia.edit',['id'=>$media->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm"><i class="far fa-edit"></i></a>
  										@endcan

  										@can('media-delete')
  											<form action="{{route('footerMedia.destroy',['id'=>$media->id])}}" method="POST">
  											@csrf
  											@method('DELETE')
  												<button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" title="@lang('global.app_delete')">
                                           		<i class="far fa-trash-alt"></i>
                                            	</button>
  											
  											</form>
  										@endcan
  									
  									</td>
  								@endcan
  							</tr>
  						@endforeach
  					@else
						<tr>
  							<th colspan="3" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
  						</tr>
  					@endif
  				</tbody>
  			</table>
  		</div>
  	</div>
@endsection
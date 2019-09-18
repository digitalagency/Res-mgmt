@extends('layouts.admin')
@section('content')

<div class="box">

	<div class="box-header">
		Trashed Information
	</div>

	<div class="box-body">
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>@lang('global.message.name')</th>
					<th>@lang('global.message.email')</th>
					<th>@lang('global.app_received_at')</th>
					<th>@lang('global.app_deleted_at')</th>
					<th>@lang('global.app_action')</th>
				</tr>
			</thead>
			<tbody>
				@if($messages->count()>0)

					@foreach($messages as $message)
						<tr>
							<td>{{$message->fullName}}</td>
							<td>{{$message->message}}</td>
							<td>{{$message->created_at}}</td>
							<td>{{$message->deleted_at}}</td>
							
							<td>
								<!-- restores the deleted message -->
								<form action="{{route('message.restore',['id'=>$message->id])}}" method="get" class="form-restore">

									@csrf
									<button type="submit" data-toggle="tooltip" title="@lang('global.app_restore')" class="btn btn-info btn-sm">
                                        <i class="fas fa-window-restore"></i>
                                    </button>
									
								</form>
								<!-- deleted the selected message succesfully -->
								<form action="{{route('message.kill',['id'=>$message->id])}}" method="get">
									@csrf
									<button type="submit" data-toggle="tooltip" title="@lang('global.app_delete') @lang('global.app_permanently')" class="btn btn-danger btn-sm">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
									
								</form>
							</td>
						</tr>
					@endforeach

				@else

					<tr>
						<th colspan="4" class="text-center"><i>@lang('global.app_no_entries_in_table')</i></th>
					</tr>

				@endif
			</tbody>
			
		</table>
		
	</div>
	
</div>
@endsection
@extends('layouts.admin')
@section('content')

@section('page-title', 'Header Contents')

@section('content')
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">
				@lang('global.header.title')
			</h3>

			<a href="{{route('profileHeader.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
		</div>

		<div class="box-body">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>@lang('global.header.fields.title')</th>
						<th>@lang('global.header.fields.contact')</th>

						@can('header-action')
							<th>@lang('global.app_action')</th>
						@endcan
					</tr>
					
				</thead>
				<tbody>
					@if($headers->count()>0)
						@foreach($headers as $header)
							<tr>
								<td>{{$header->title}}</td>
								<td>{{$header->contact}}</td>
							
								@can('header-action')
									<td class="action">
										@can('header-edit')
											<a href="{{route('profileHeader.edit',['id'=>$header->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
											<i class="far fa-edit"></i>
											</a>
										@endcan

										@can('header-delete')
											<form action="{{route('profileHeader.destroy',['id'=> $header->id])}}" method="POST">
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
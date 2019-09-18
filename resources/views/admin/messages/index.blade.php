@extends('layouts.admin')
@section('content')

<div class="row">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Messages</h3>
			<a href="{{route('message.trashed')}}" class="btn btn-danger pull-right">Trashed</a>
		</div>
		<div class="box-body">
			<table id="example1" class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>@lang('global.message.name')</th>
						<th>@lang('global.message.email')</th>
						<th style="padding-left: 15px;">@lang('global.message.contact')</th>
						<th style="padding-left: 10%;padding-right: 130px;">@lang('global.message.message')</th>
						<th style="padding-left: 2%;margin-left: 10%;">@lang('global.message.budget')</th>
						@can('message-action')
							<th>@lang('global.app_action')</th>
						@endcan
					</tr>
				</thead>
				<tbody>
					@if($messages->count()>0)
						@foreach($messages as $message)
							<tr>
								<td style="width: 20px;">{{$message->fullName}}</td>
								<td style="width: 35px;">{{$message->email}}</td>
								<td style="width: 13%;padding-left: 15px;">{{$message->contact}}</td>

								<td style="width: 40px;">

			                            {{ str_limit($message->message, 50, '') }}   
			                            <!-- checks if the string limit of a message is greater than 50 or not -->    
			                            @if (strlen($message->message) > 50)   

			                            	<!-- displays message upto only 50 letters -->
			                            	<!-- displays the remaining message in a dialog box, if 'read more' button is clicked -->
			                            	<button style="border:none;padding: 0px;background: none;color: green;font-weight: bold;" data-toggle="modal" data-target = "#more_{{$message->id}}" class="moreThan">Read More..</button> 

			                            	<div class="modal fade" id="more_{{$message->id}}" tabindex="-1" aria-hidden="true" role="dialog">
			                            		<div class="modal-dialog" role="document">
			                            			<div class="modal-content">
			                            				<div class="modal-header">
			                            					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                            						<span aria-hidden="true">&times;</span>
			                            					</button>
			                            					<h3 class="modal-title">Message From: {{$message->fullName}}</h3>
			                            				</div>
			                            				<div class="modal-body">
			                            					{{$message->message}}
			                            				</div>
			                            			
			                            			</div>
			                            		
			                            		</div>
			                            	</div>      
			                                <!-- <span class="dots">...</span>
			                                <span class="more">{!! substr($message->message, 50) !!}</span>
			                                <button class="btn btn-primary readMore">Read More...</button> -->
			                            @endif
			                        
								</td>
								<td style="padding-left: 2%;margin-left: 10%;">{{$message->budgetLevel}}</td>

								@can('message-action')

									<td class="action">
										<!-- deletes the message if the user has access to delete the message -->
										@can('message-delete')

											<form action="{{route('message.destroy',['id'=>$message->id])}}" method="POST">
											@csrf
											@method('DELETE')
												<button type="submit" data-toggle="tooltip" title="@lang('global.app_trash')" class="btn btn-danger btn-sm">
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
</div>

@endsection
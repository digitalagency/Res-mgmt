@extends('layouts.admin')
@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
	<div class="row">
		<div class="products">
			@foreach ($products as $product)
				<div class="col-sm-6 col-lg-4">
					<div class="product-info">
						<div class="box">
							<div class="box-body">
								<a class="pull-left" href="#">
									<img class="" width="100" src="{{$product->featuredImage()->image}}" alt="{{$product->name}}">
								</a>
								<div class="member-info">
									<h4 class="m-t-0 m-b-5 header-title"><b>{{$product->name}}</b></h4>
									<input hidden class="product-id" value="{{$product->id}}"> 
									<input hidden class="p-status" value="{{$product->status}}"> 
									<p class="text-muted product-status">
										@if ($product->status == 1)
											Active
										@else
											Inactive
										@endif
									</p>
									{{-- <h4 class=""><i class="md md-business m-r-10"></i>Order :571</h4> --}}
									<div class="contact-action">
										@can('product-edit')
											<a href="{{route('product.edit', ['id' => $product->id])}}" 
												data-toggle="tooltip" 
												title="@lang('global.app_edit')" 
												class="btn btn-success btn-sm"
											>
												<i class="far fa-edit"></i>
											</a>
										@endcan
										@can('product-single')
											<a href="{{route('product.single', ['product' => $product->slug])}}" 
												data-toggle="tooltip" 
												title="@lang('global.app_edit')" 
												class="btn btn-info btn-sm"
											>
												<i class="fas fa-info-circle"></i>
											</a>
										@endcan
										@can('product-delete')
											<button class="delete btn btn-danger btn-sm" 
												data-type="DELETE" data-toggle="tooltip" 
												data-url="{{route('product.delete', ['id' => $product->id])}}" 
												title="@lang('global.app_delete')"
											>
												<i class="far fa-trash-alt"></i>
											</button>
										@endcan
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		
	</div>

@endsection
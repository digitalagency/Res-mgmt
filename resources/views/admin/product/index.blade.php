@extends('layouts.admin')

@section('page-title', 'Products')

@section('content')
	<div class="box">
		<div class="box-header">
			<h3 class="box-title>">List of Products</h3>
            <a href="{{route('product.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Category</th>
						<th>Price</th>
						<th>Description</th>
						<th>Status</th>
						<th>Featured</th>
						<th>Created At</th>
						@can('product-action')
							<th>Action</th>
						@endcan
					</tr>
				</thead>
				<tbody>
					@if($products->count()>0)
						@foreach($products as $product)
							<tr>
								<td>{{$product->name}}</td>
								<td>{{$product->category->name}}</td>
								<td>{{$product->price}}</td>
								<td>{{$product->description}}</td>
								<td>{{$product->status}}</td>
								<td>{{$product->featured}}</td>
								<td>{{$product->created_at->toFormattedDateString()}}</td>

								@can('product-action')
									<td class="action">
										@can('product-edit')
                							<a href="{{route('product.edit', ['id' => $product->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-info btn-sm">
                							<i class="far fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('product-delete')
                                        	<form action="{{route('product.destroy', ['id' => $product->id])}}" method="post" >
                                            @csrf
                                            @method('delete')
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
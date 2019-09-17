@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

	<div class="box">
		<div class="box-header">
            <h3 class="box-title">@lang('global.category.title')</h3>
            @can('category-add')
                <a href="{{route('category.create')}}" class="btn btn-success pull-right">@lang('global.app_new')</a>
            @endcan
        </div>
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>@lang('global.category.field.name')</th>
                        <th>@lang('global.app_created_at')</th>
                        @can('category-action')
                            <th>@lang('global.app_action')</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @if($categories->count() > 0)
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->created_at}}</td>
                                @can('category-action')
                                    <td class="action">
                                        @can('category-edit')
                                            <a href="{{route('category.edit', ['id' => $category->id])}}" 
                                                data-toggle="tooltip" title="@lang('global.app_edit')" 
                                                class="btn btn-success btn-sm"
                                            >
                                                <i class="far fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('category-single')
                                            <a href="{{route('category.single', ['category' => $category->slug])}}" 
                                                data-toggle="tooltip" title="@lang('global.app_edit')" 
                                                class="btn btn-info btn-sm"
                                            >
                                                <i class="fas fa-info-circle"></i>
                                            </a>
                                        @endcan
                                        @can('category-delete')
                                            <form action="{{route('category.destroy', ['id' => $category->id])}}" method="post" >
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
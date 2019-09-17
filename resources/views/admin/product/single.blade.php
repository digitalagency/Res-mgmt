@extends('layouts.admin')
@section('title', $product->name)
@section('page-title', 'Product')
@section('content')
    <div class="box">
        <div class="box-body">
            <div class="row">
                <!--Featured Image of a product-->
                <div class="col-xs-12 col-md-5 main-image">
                    <img src="{{$product->featuredImage()->image}}" alt="{{$product->name}}">
                </div>
                <div class="col-xs-12 col-md-7">
                    <!--Contents of a product including its description-->
                    <div class="product-details">
                        <h1 class="product-title">
                            <strong>{{$product->name}}</strong>
                            <!-- Product Metadata Modal link -->
                            @can('product-metadata')
                                <small>
                                    <a href="#metadata" data-toggle="modal">@lang('global.product.metadata.title')</a>
                                </small>
                            @endcan
                            @can('product-edit')
                                <a href="{{route('product.edit', ['id' => $product->id])}}" data-toggle="tooltip" title="@lang('global.app_edit')" class="btn btn-success btn-sm pull-right">
                                    <i class="far fa-edit"></i>
                                </a>
                            @endcan
                        </h1>
                        <h2 class="product-category">
                            <span class="category">@lang('global.category.title'):</span>
                            <a href="{{route('category.single', ['slug' => $product->category->slug])}}">
                                {{$product->category->name}}
                            </a>
                        </h2>
                        <h3 class="product-price"><span class="price">@lang('global.product.fields.price'):</span> {{$product->price}}</h3>
                        
                        <p class="product-description">
                            {!! str_limit($product->description, 950, '') !!}       {{--Displaying only 950 characters--}}
                            @if (strlen($product->description) > 950)               {{--Checking if the document contains more than 950 characters--}}
                                <span id="dots">...</span>
                                <span id="more">{!! substr($product->description, 950) !!}</span>
                                <button class="btn btn-primary" id="readMore">@lang('global.app_read_more')</button>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="popup-gallery">
        @foreach ($images as $image)            {{--Display all the images of the product--}}
            <div class="col-xs-6 col-lg-3 col-md-4">
                <div class="gal-detail thumb
                    @if ($image->featured)      {{--Check if the image is featured or not--}}
                        featured"
                    @else
                        "
                    @endif
                >
                    <a href="{{$image->image}}" title="">
                        <img src="{{$image->image}}" alt="{{$product->name}}" width="300" height="200">
                    </a>
                </div>
            </div>
        @endforeach
        </div>
    </div>
    @can('product-metadata')
        <!-- Product Metadata Starts here -->
        <div class="modal fade" tabindex="-1" id="metadata" role="dialog" aria-labelledby="metadataModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="metadataModal">
                            <strong>{{$product->name}}</strong> 
                            <small>@lang('global.product.metadata.title')</small>
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="meta-title">
                            <label>@lang('global.product.metadata.fields.title'):</label>
                            <p id="metaTitle">{{$product->meta_title}}</p>
                        </div>
                        <div class="meta-keywords">
                            <label>@lang('global.product.metadata.fields.keywords'):</label>
                            <p id="metaKeywords">{{$product->meta_keywords}}</p>
                        </div>
                        <div class="meta-description">
                            <label>@lang('global.product.metadata.fields.description'):</label>
                            <p id="metaDescription">{{$product->meta_description}}</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  data-target="#productMetadataEdit" data-toggle="modal" data-dismiss="modal" class="btn btn-warning">@lang('global.app_edit')</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('global.app_close')</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Product Metadata Ends Here -->
    
        <!-- Product Metadata Edit Modal Starts Here -->
        <div class="modal fade" role="dialog" id="productMetadataEdit" tableindex="-1" aria-labelledby="metadataEdit" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="metadataEdit">
                            <strong>{{$product->name}}</strong>
                            <small>@lang('global.product.metadata.title')</small>
                        </h3>
                    </div>
                    <form action="{{route('edit.metadata', ['id' => $product->id])}}" method="post" id="metadataEditForm">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>@lang('global.product.metadata.fields.title')<span class="text-danger">*</span></label>
                                <input type="text" 
                                    value="{{$product->meta_title}}" 
                                    placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.title') @lang('global.app_here')"
                                    name="meta_title" 
                                    class="form-control"
                                >
                                <p class="hide text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label>@lang('global.product.metadata.fields.keywords')<span class="text-danger">*</span></label>
                                <input type="text" 
                                    value="{{$product->meta_keywords}}" 
                                    placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.keywords') @lang('global.app_here')" 
                                    name="meta_keywords" 
                                    class="form-control"
                                >
                                <p class="hide text-danger"></p>
                            </div>
                            <div class="form-group">
                                <label>@lang('global.product.metadata.fields.description')<span class="text-danger">*</span></label>
                                <textarea name="meta_description" 
                                    placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.description') @lang('global.app_here')..." 
                                    class="form-control" 
                                    rows="5"
                                >
                                    {{$product->meta_description}}
                                </textarea>
                                <p class="hide text-danger"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">@lang('global.app_submit')</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal" data-target="#metadata">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Product Metadata Edit Modal Ends Here -->
    @endcan
@endsection
@extends('layouts.admin')
@section('title', $product->name)
@section('page-title', 'Product')

@section('content')
    <form id="fileupload" action="{{route('product.u', ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="box">
                    <div class="box-header">
                        <!--Product Title-->
                        <h3 class="box-title">
                            @lang('global.app_edit') @lang('global.product.title'): 
                            <strong>
                                {{$product->name}}
                            </strong>
                        </h3>
                    </div>
                    <!--Product Details For Editing-->
                    <div class="box-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">@lang('global.product.fields.name')<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control">	
                            <p class="hide error text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label>@lang('global.product.fields.slug')</label>
                            <input type="text" name="slug" id="slug" class="form-control" value="{{$product->slug}}">
                        </div>
                        <div class="form-group">
                            <label for="price">@lang('global.product.fields.price')<span class="text-danger">*</span></label>
                            <input type="number" name="price" id="name" value="{{$product->getOriginal('price')}}" class="form-control">
                            <p class="hide text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="category_id">@lang('global.category.title')<span class="text-danger">*</span></label>	
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="{{$product->category->id}}">{{$product->category->name}}</option>    {{--Displting product category at first--}}
                                @foreach ($categories as $category)                                                 {{--Displaying all categories--}}
                                    @if ($product->category->id != $category->id)                                   {{--Checking the product category with category list to skip that category--}}
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('global.product.fields.description')<span class="text-danger">*</span></label>
                            <!--Bootstrap-wysihtml5 Text Editor-->
                            <div class='pad'>
                                <textarea class="textarea" name="description" id="description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {{$product->description}}
                                </textarea>
                                <p class="hide text-danger"></p>
                            </div>
                        </div>
                        <!--Product Image Add/View Section-->
                        <div class="image-section">
                            <label>@lang('global.product.title') @lang('global.product.fields.images')<span class="text-danger">*</span></label>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>@lang('global.product.fields.add_files')</span>
                                        <input type="file" name="files[]" multiple />
                                    </span>
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>@lang('global.product.fields.cancel_upload')</span>
                                    </button>
                                    <button type="button" class="btn btn-danger delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <span>@lang('global.product.fields.delete_selected')</span>
                                    </button>
                                    <input type="checkbox" class="toggle" />
                                    <!-- The global file processing state -->
                                    <span class="fileupload-process"></span>
                                </div>
                                <!-- The global progress state -->
                                <div class="col-lg-5 fileupload-progress fade">
                                    <!-- The global progress bar -->
                                    <div
                                        class="progress progress-striped active"
                                        role="progressbar"
                                        aria-valuemin="0"
                                        aria-valuemax="100"
                                    >
                                        <div
                                            class="progress-bar progress-bar-success"
                                            style="width:0%;"
                                        ></div>
                                    </div>
                                    <!-- The extended global progress state -->
                                    <div class="progress-extended">&nbsp;</div>
                                </div>
                            </div>
                            <input hidden name="featuredImage" id="featuredImage" value="{{$product->featuredImage()->getOriginal('image')}}">
                            <p class="hide text-danger"></p>
                            <!-- The table listing the files available for upload/download -->
                            <table role="presentation" class="table table-striped update-table">
                                <tbody class="files">
                                    @foreach ($images as $image)                        {{-- Get all images of the product --}}
                                    <tr class="template-download {{array_key_exists('featured',  $image) ? 'featured-image' : ''}}">
                                            <!-- Image Preview -->
                                            <td>
                                                <span class="preview">
                                                    @if ($image['thumbnailUrl'])        {{-- Check if $image array contains thumbnailUrl or not --}}
                                                        <a href="{{$image['url']}}" title="{{$image['name']}}" download="{{$image['name']}}" data-gallery>
                                                            <img src="{{$image['thumbnailUrl']}}">
                                                        </a>
                                                    @endif
                                                </span>
                                            </td>
                                            <!--Image Name-->
                                            <td>
                                                <p class="name">
                                                    @if($image['url'])                  {{-- Check if $image array contains url or not --}}
                                                        <a href="{{$image['url']}}" class = "image-name" title="{{$image['name']}}" download="{{$image['name']}}" >{{$image['name']}}</a>
                                                    @else
                                                        <span class="image-name">{{$image['name']}}</span>
                                                    @endif
                                                </p>
                                            </td>
                                            <!--Image Size-->
                                            <td>
                                                <input type="hidden" name="imageId[]" value="{{$image['imageId']}}">
                                                <span class="size">{{$image['size']}}</span>
                                            </td>
                                            <!--Delete or Cancel button-->
                                            <td>
                                                @if($image['deleteUrl'])                {{-- Check if $image array contains deleteUrl or not --}}
                                                    <button class="btn btn-danger delete" data-type="{{$image['deleteType']}}" data-url="{{$image['deleteUrl']}}">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                        <span>@lang('global.app_delete')</span>
                                                    </button>
                                                    {{-- <input type="checkbox" name="delete" value="1" class="toggle"> --}}
                                                @else
                                                    {{--Display cancel button if deleteUrl is not present in an array--}}
                                                    <button class="btn btn-warning cancel">
                                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                                        <span>@lang('global.app_cancel')</span>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End of table listing the files available for upload/download -->
                        </div>
                        <!--Product Upadte Button-->
                        <div class="fileupload-buttonbar">
                            <button type="submit" class="btn btn-primary start edit">
                                <span>@lang('global.app_update')</span>
                            </button>
                        </div>
                        <!--JavaScript lightweight template with zero dependencies for adding new images/show uploaded images -->
                        @include('admin.includes.imageScript')
                    </div>
                </div>
            </div>
            <!-- Right Sidebar for Updating the Status and Featured of the Product Starts Here-->
            <div class="right-sidebar">
                <div class="col-xs-12 col-md-3">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@lang('global.app_additional_settings')</h3>
                        </div>
                        <div class="box-body">
                            <div class="additional-setting-body">
                                <!--Status Toggle Switch-->
                                <div class="status row">
                                    <div class="col-md-6">
                                        <label>@lang('global.app_status')</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="switch pull-right">
                                        <input type="checkbox" name="status" value="{{$product->status}}" {{($product->status == 1) ? 'checked' : ''}}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                @can('product-featured')
                                    <!--Featured Toggle Switch-->
                                    <div class="featured row">
                                        <div class="col-md-6">
                                            <label>@lang('global.app_featured')</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="switch pull-right">
                                                <input type="checkbox" name="featured" value="{{$product->featured}}" {{($product->featured == 1) ? 'checked' : ''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                    @can('product-metadata')
                        <!-- Meta Description Section Starts Here -->
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">@lang('global.product.metadata.title')</h3>
                            </div>
                            <div class="box-body">
                                <div class="meta-description">
                                    <div class="form-group">
                                        <label>@lang('global.product.metadata.fields.title')<span class="text-danger">*</span></label>
                                        <input type="text" name="meta_title" value = "{{$product->meta_title}}" class="form-control title" placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.title') @lang('global.app_here')...">
                                        <p class="hide text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('global.product.metadata.fields.keywords')<span class="text-danger">*</span></label>
                                        <input type="text" name="meta_keywords" value = "{{$product->meta_keywords}}" class="form-control" placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.keywords') @lang('global.app_here')...">
                                        <p class="hide text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('global.product.metadata.fields.description')<span class="text-danger">*</span></label>
                                        <textarea name="meta_description" 
                                            placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.description') @lang('global.app_here')..." 
                                            class="form-control"
                                        >
                                            {{$product->meta_description}}
                                        </textarea>
                                        <p class="hide text-danger"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Meta Description Section Ends Here -->
                    @endcan
                </div>
            </div>
            <!--Right Sidebar Ends Here -->
        </div>
    </form>
    <!--Produt Edit Form Ends Here-->
@endsection
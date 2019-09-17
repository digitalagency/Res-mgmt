@extends('layouts.admin')
@section('title' , 'Create New Product')
@section('page-title', 'Product')

@section('content')
<div id="response"></div>
    <!-- New Product Add Form Starts Here -->
    <form id="fileupload" action="{{route('product.store')}}" method="POST" enctype='multipart/form-data'>
        <div class="row">
            <div class="col-xs-12 col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">@lang('global.app_add') @lang('global.product.title')</h3>
                    </div>
                    <div class="box-body">
                        @csrf
                        <div class="form-group">
                            <label for="name">@lang('global.product.fields.name')<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>@lang('global.product.fields.slug')</label>
                            <input type="text" name="slug" id="slug" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price">@lang('global.product.fields.price')<span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="category_id">@lang('global.category.title')<span class="text-danger">*</span></label>	
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($categories as $category)         {{--Displaying all the categories--}}
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="product-description">
                            <div class="form-group">
                                <label for="description">@lang('global.product.fields.description')<span class="text-danger">*</span></label>
                                <div class='pad'>
                                    <!--Bootstrap-wysihtml5 Text Editor for description-->
                                    <textarea class="textarea" name="description" placeholder="Place some text here" 
                                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    </textarea>
                                </div>
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
                        </div>
                        <input hidden name="featuredImage" id="featuredImage" value="">
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped">
                            <tbody class="files"></tbody>
                        </table>
                        <!-- New Product Submit Button -->
                        <div class="fileupload-buttonbar">
                            <button type="submit" class="btn btn-primary start">
                                <span>@lang('global.app_submit')</span>
                            </button>
                        </div>
                        <!-- The blueimp Gallery widget -->
                        <div
                        id="blueimp-gallery"
                        class="blueimp-gallery blueimp-gallery-controls"
                        data-filter=":even"
                        >
                            <div class="slides"></div>
                            <h3 class="title"></h3>
                            <a class="prev">‹</a>
                            <a class="next">›</a>
                            <a class="close">×</a>
                            <a class="play-pause"></a>
                            <ol class="indicator"></ol>
                        </div>
                    </div>
                    <!--JavaScript lightweight template with zero dependencies for adding new images/show uploaded images -->
                    @include('admin.includes.imageScript')
                </div>
            </div>
            <!-- Right Sidebar for Updating the Status and Featured of the Product Starts Here-->
            <div class="right-sidebar">
                <div class="col-md-3 col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">@lang('global.app_additional_settings')</h3>
                        </div>
                        <div class="card-body">
                            <div class="additional-setting-body">
                                <!--Status Toggle Switch-->
                                <div class="status row">
                                    <div class="col-md-6">
                                        <label>@lang('global.app_status')</label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="switch pull-right">
                                            <input type="checkbox" name="status" value="0">
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
                                                <input type="checkbox" name="featured" value="0">
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
                                        <input type="text" name="meta_title" class="form-control title" placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.title') @lang('global.app_here')...">
                                        <p class="hide text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('global.product.metadata.fields.keywords')<span class="text-danger">*</span></label>
                                        <input type="text" name="meta_keywords" class="form-control" placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.keywords') @lang('global.app_here')...">
                                        <p class="hide text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('global.product.metadata.fields.description')<span class="text-danger">*</span></label>
                                        <textarea name="meta_description" placeholder="@lang('global.app_enter') @lang('global.product.metadata.fields.description') @lang('global.app_here')..." class="form-control"></textarea>
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
    <!--Product Add Form Ends Here-->
@endsection
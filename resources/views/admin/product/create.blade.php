@extends('layouts.admin')


@section('content')
    <form id="fileupload" action="{{route('product.store')}}" method="POST" enctype='multipart/form-data'>
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Products</h3>
                    </div>
                    <div class="box-body">
                         @if (count($errors) > 0)
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item alert alert-danger text-danger" role="alert">
                                        {{$error}}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>	
                            <select name="category_id" id="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <div class='pad'>
                                <!--Textarea for description-uses bootstrap-wysihtml5-->
                                <textarea class="textarea" name="description" placeholder="Place some text here" 
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                        </div>
                        <!--Product Image Add Section-->
                        <div class="image-section">
                            <label>Product Images</label>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="row fileupload-buttonbar">
                                
                                <div class="col-lg-7">
                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Add files...</span>
                                        <input type="file" name="files[]" multiple />
                                    </span>
                                    {{-- <button type="submit" class="btn btn-primary start">
                                        <i class="glyphicon glyphicon-upload"></i>
                                        <span>Start upload</span>
                                    </button> --}}
                                    <button type="reset" class="btn btn-warning cancel">
                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                        <span>Cancel upload</span>
                                    </button>
                                    <button type="button" class="btn btn-danger delete">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <span>Delete selected</span>
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
                        <div class="fileupload-buttonbar">
                            <button type="submit" class="btn btn-primary start">
                                <span>Submit</span>
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
                        
                    @include('admin.includes.imageScript')
                </div>
            </div>
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Additional Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="additional-setting-body">
                            <div class="featured row">
                                <div class="col-md-6">
                                    <label>Featured</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="switch pull-right">
                                        <input type="checkbox" name="featured" value="0">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="status row">
                                <div class="col-md-6">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="switch pull-right">
                                        <input type="checkbox" name="status" value="0">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection
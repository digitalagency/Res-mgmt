@extends('layouts.admin')


@section('content')
    <form id="fileupload" action="{{route('product.u', ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-9">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Edit Product</h3>
                    </div>
                    <div class="box-body">
                    
                        @csrf
                        {{-- @method('PUT') --}}

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control">	
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="name" value="{{$product->price}}" class="form-control">
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
                                <textarea class="textarea" name="description" id="description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                    {{$product->description}}
                                </textarea>
                            </div>
                        </div>
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
                        <!-- The table listing the files available for upload/download -->
                        <table role="presentation" class="table table-striped update-table">
                            <tbody class="files">
                                @foreach ($images as $image)
                                    <tr class="template-download">
                                        <td>
                                            <span class="preview">
                                                @if ($image['thumbnailUrl'])
                                                    <a href="{{$image['url']}}" title="{{$image['name']}}" download="{{$image['name']}}" data-gallery>
                                                        <img src="{{$image['thumbnailUrl']}}">
                                                    </a>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <p class="name">
                                                @if($image['url'])
                                                    <a href="{{$image['url']}}" title="{{$image['name']}}" download="{{$image['name']}}" >{{$image['name']}}</a>
                                                @else
                                                    <span>{{$image['name']}}</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <input type="hidden" name="imageId[]" value="{{$image['imageId']}}">
                                            <span class="size">{{$image['size']}}</span>
                                        </td>
                                        <td>
                                            @if($image['deleteUrl'])
                                                <button class="btn btn-danger delete" data-type="{{$image['deleteType']}}" data-url="{{$image['deleteUrl']}}">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                                <input type="checkbox" name="delete" value="1" class="toggle">
                                            @else
                                                <button class="btn btn-warning cancel">
                                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                                    <span>Cancel</span>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="fileupload-buttonbar">
                            <button type="submit" class="btn btn-primary start edit">
                                <span>Submit</span>
                            </button>
                        </div>
                        @include('admin.includes.imageScript')
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Additional Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="additional-setting-body">
                            <div class="status row">
                                <div class="col-md-6">
                                    <label>Status</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="switch pull-right">
                                    <input type="checkbox" name="status" value="{{$product->status}}"
                                    @if ($product->status == 1)
                                        checked
                                    @endif
                                    >
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="featured row">
                                <div class="col-md-6">
                                    <label>Featured</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="switch pull-right">
                                        <input type="checkbox" name="featured" value="{{$product->featured}}"
                                        @if ($product->featured == 1)
                                            checked
                                        @endif
                                        >
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
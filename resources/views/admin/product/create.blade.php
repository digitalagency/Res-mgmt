@extends('layouts.admin')


@section('content')

<div class="box">
	<div class="box-header">
        <h3 class="box-title">Products
        </h3>
    </div>
    <div class="box-body">
    	<form action="{{route('product.store')}}" method="POST" enctype='multipart/form-data'>
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
                    <textarea class="textarea" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
    		</div>
    		<div class="form-group">
    			<label for="featured" style="padding-bottom: 10px, margin-left:30px;">Display as featured</label>
                <input type="radio" name="featured" id="featured" value="YES" unchecked style="margin-left: 30px;">Yes
    			<input type="radio" name="featured" id="featured" checked="" value="NO" style="margin-left: 20px;">NO
    		</div>
            <div class="form-group">
                <label for="status" style="padding-bottom: 10px;">Display status</label>
                 <input type="radio" name="status" id="status" value="1" unchecked style="margin-left: 65px;">Yes
                <input type="radio" name="status" id="status" value="0" style="margin-left: 23px;" checked="">NO
            </div>

            <div class="input-group control-group increment" >
                <label for="image">Add multiple image</label>
                <input type="file" name="image[]" class="form-control" multiple>
                <div class="input-group-btn" style="padding-top: 27px;"> 
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                </div>
            </div>
            <div class="clone hide">
                <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" name="image[]" class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                </div>
            </div>

        	<div class="form-group">
    			<button type="submit" class="btn btn-success" style="margin-top: 15px;">@lang('global.app_submit')</button>
            </div>
    		
    	</form>
    </div>

</div>


@endsection
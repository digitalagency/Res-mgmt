@extends('layouts.admin')


@section('content')

<div class="box">
	<div class="box-header">
		<h3 class="box-title">Edit Product</h3>
	</div>
	<div class="box-body">
		<form action="{{route('product.update', ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
			@csrf
			@method('PUT')

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

                    <textarea class="textarea" name="description" id="description" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$product->description}}
                    </textarea>
                </div>
    		</div>
          <!--   <div class="form-group">
                <img src="">
            </div> -->

            <?php 
                $allimages = json_decode($product->image);

                echo '<pre>';
                    print_r($allimages);
                echo '</pre>';
            ?>

    		<div class="input-group control-group increment" >
                <label for="image">Post multiple image</label>
                <input type="file" name="image[]" class="form-control" value="" multiple>
                <div class="input-group-btn" style="padding-top: 27px;"> 
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                </div>
            </div>
            <div class="clone hide">
                <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" name="image[]" class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i>Remove</button>
                    </div>
                </div>
            </div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit" style="margin-top: 15px;">Update</button>
	        </div>
		</form>
		
	</div>
	
</div>
@endsection
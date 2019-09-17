@extends('layouts.admin')

@section('title', $category->name)

@section('content')
    <div class="box">
        <div class="box-header">
            <!--Category Title-->
            <h1 class="category-title">
                @lang('global.category.title'): 
                <strong>{{$category->name}}</strong>
            </h1>
        </div>
        <!--Category Content-->
        <div class="box-body">
            <div class="col-xs-12 col-md-5 main-image">
                @foreach ($products as $product)            {{--Display only one featured image of a one product--}}
                    <img src="{{$product->featuredImage()->image}}" alt="{{$product->name}}">
                    @break
                @endforeach
            </div>
            <div class="col-xs-12 col-md-7">
                <span><b>@lang('global.category.dish_types')</b></span>
                <table class="category-products table table-striped table-bordered">
                    <tbody>
                        @foreach ($products as $product)    {{--Display products that falls under this category with its price--}}
                            <tr data-href="{{route('product.single', ['product' => $product->slug])}}">
                                <td>
                                    <span class="category-product">{{$product->name}}</span>
                                    <span class="pull-right">{{$product->price}}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--Category Content Ends Here-->
    </div>
    <div class="row">
        <!--Popup gallery for the images of the product-->
        <div class="popup-gallery">
            @foreach ($products as $product)            {{--Display featured images of all products that falls under this category--}}
                <div class="col-xs-6 col-lg-3 col-md-4">
                    <div class="gal-detail thumb text-center">
                        <a href="{{$product->featuredImage()->image}}" title="{{$product->name}}">
                            <img src="{{$product->featuredImage()->image}}" alt="{{$product->name}}">
                        </a>
                        <strong style="font-size: 25px">{{$product->name}}</strong>
                    </div>
                </div>
            @endforeach
        </div>
        <!--Popup Gallery Ends Here-->
    </div>
@endsection
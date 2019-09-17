<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Session;


class ProductController extends Controller
{
    private $productId;

    /**
     * Change serialized data into an array
     */
    private function serializeToArray($data)
    {
        $newData = array();
        parse_str($data, $newData);
        return $newData;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        if(! Gate::allows('product-view')){
            return abort(401);
        }
        return view('admin.product.index')->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!Gate::allows('product-add')) {
            return abort(401);
        }
        return view('admin.product.create')->with('categories', Category::all());
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('product-add')) {
            return abort(401);
        }
        /**
         * Check if the product exists into the database or not to prevent duplicate data entry 
        *  into the database as blueimp fileupload sends multiple requests when there are multiple files
         */
        if (!Product::where('name', $request->name)->first()) {
            $request->validate([
                'name' => 'required',
                'price' => 'integer|required|between:1,5000',
                'category_id' => 'required|integer',
                'description' => 'required',
                'featuredImage' => 'required',
                'meta_title' => 'required|max:70',
                'meta_keywords' => 'required',
                'meta_description' => 'required|max:160'
            ]);
            $product = Product::create($request->all());
            $this->productId = $product->id;
            $product->slug = $this->slugGenerator($request);
            $product->save();
        }
        else{
            $product = Product::where('name', $request->name)->first();
            $this->productId = $product->id;
        }
        //get images from the request and send it to saveImage() of ImageController class
        $images = $request->file('files');
        if ($images) {
            $imageContr = new ImageController();
            $response = $imageContr->saveImage($images, $this->productId, $request->featuredImage);
            return $response;
        }
        
        Session::flash('success', "Product created");

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('product-edit')) {
            return abort(401);
        }
        $obj = new ImageController();
        $images = $obj->getAllRelatedImages($id);
        return view('admin.product.edit')->with('product',Product::find($id))
                                            ->with('categories', Category::all())
                                            ->with('images', $images);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Gate::allows('product-edit')) {
            return abort(401);
        }
        $request->validate([
            'description' => 'required',
            'category_id' => 'required|integer',
            'meta_description' => 'required'
        ]);
        
        // dd($request->all());
        $product = Product::findOrFail($id);
        //check if the Ajax HTTP post request contains image or not
        if($request->data != null){
            $updateData = $this->serializeToArray($request->data);
            $validator = Validator::make($updateData, [
                'name' => 'required',
                'price' => 'integer|required|between:1,5000',
                'featuredImage' => 'required',
                'meta_title' => 'required|max:70',
                'meta_keywords' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->messages(), 409);
            }
            // dd($updateData);
            $product->update([
                'name' => $updateData['name'],
                'slug' => array_key_exists('slug', $updateData)? $updateData['slug'] : $updateData['name'],
                'price' => $updateData['price'],
                'description' => $request->description,
                'status' => !array_key_exists('status', $updateData) ? 0 : 1,
                'featured' => !array_key_exists('featured', $updateData) ? 0 : 1,
                'category_id' => $request->category_id,
                'meta_title' => $updateData['meta_title'],
                'meta_keywords' => $updateData['meta_keywords'],
                'meta_description' => $request->meta_description,
            ]);
            $imageContr = new ImageController();
            $imageContr->featuredImage($updateData['featuredImage'], $id);

            Session::flash('success', 'Product Updated Successfully!!!');

            return $product;

        }else{
            $product->update($request->all());
            $product->slug = $this->slugGenerator($request);
            $product->save();
            $images = $request->file('files');
            if($images){
                $imageContr = new ImageController();
                $response = $imageContr->saveImage($images, $id, $request->featuredImage);
            }

            Session::flash('success', 'Product Updated Successfully!!!');
            return $response;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('product-delete')){
            return abort(401);
        }
        $deleteId = Product::find($id)->delete();
        if ($deleteId) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Change the status and featured status of the product based on get request
     * coming from ajax
     */
    public function status(Request $request)
    {
        if($request->has('status')){            //Check if the request has status parameter or not
            $product = Product::singleproduct('id', $request->productId);
            $product->status = $request->status;
            $product->save();
        }elseif($request->has('featured')){     //Check if the request has featured parameter or not
            $product = Product::singleproduct('id', $request->productId);
            $product->featured = $request->featured;
            $product->save();
        }
    }
    
    /**
     * Display the details of a product along with its category and images
     * 
     * @param slug $product
     */
    public function single($product)
    {
        if (!Gate::allows('product-single')) {
            return abort(401);
        }
        $product = Product::singleproduct('slug', $product);
        $category = $product->category;
        $images = $product->images;
        return view('admin.product.single')->with('product', $product)
                                            ->with('category', $category)
                                            ->with('images', $images);
    }

    /**
     * 
     * @param int productId $id
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function editMetadata($id, Request $request)
    {
        if (!Gate::allows('product-metadata')) {
            return abort(401);
        }
        $product = Product::singleproduct('id', $id);
        $request->validate([
            'meta_title' => 'required|max:70',
            'meta_keywords' => 'required',
            'meta_description' => 'required|max:160'
        ]);
        $product->update([
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description
        ]);
        return $product;

    }
    /**
     * Generates a slug of a sentence
     * 
     * @param Request $request
     * @return string $slugValue
     */
    private function slugGenerator(Request $request){
        if ($request->get('slug')) {
            $slugValue = $request->slug;
        } else {
            $slugValue = $request->name;
        }
        return $slugValue;
    }
}

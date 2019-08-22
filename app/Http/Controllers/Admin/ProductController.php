<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Session;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    private $productId;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(! Gate::allows('category-view')){
        //     return abort(401);
        // }
        return view('admin.product.index')->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // if (!Gate::allows('product-add')) {
        //     return abort(401);
        // }
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


        // if (!Gate::allows('product-add')) {
        //     return abort(401);
        // }
        /**
         * Check if the product exists into the database or not to prevent duplicate data entry 
        *  into the database as blueimp fileupload sends multiple requests when there are multiple files
         */
        if (!Product::where('name', $request->name)->first()) {
            $this->validate($request, [
                'name' => 'required',
                'price' => 'integer|required|between:1,5000',
                'category_id' => 'required|integer',
                'description' => 'required',
            ]);
            $product = Product::create($request->all());
            $this->productId = $product->id;
            $product->slug = str_slug($request->name);
            $product->save();
        }
        else{
            $product = Product::where('name', $request->name)->first();
            $this->productId = $product->id;
        }
        // dd($request->name);
        // $data = $this->serializeToArray($request);
        // // dd($data);
        // $req = new Request([
        //     'name' => $data['name'],
        //     'description' => $request->description,
        //     'price' => $data['price'],
        // ]);
        // $this->validate($req, [
        //     'name' => 'required',
        //     'price' => 'required|integer|between:1,10000',
        //     'description' => 'required'
        // ]);
        // $validator = Validator::make($data, [
        //     'value.name' => 'required',
        //     'value.price' => 'required',
        //     // 'description' => 'required',
        //     'status' => 'required',
        //     'featured' => 'required',
        // ]);

        // dd($validator);

        // // dd($value);
        // if(!Product::where('name', $data['name'])->first()){
        //     Product::create([
        //         'category_id' => $request->category_id,
        //         'slug' => str_slug($data['name']),
        //         'name' => $data['name'],
        //         'price' => $data['price'],
        //         'description' => $request->description,
        //         'status' => $data['status'],
        //         'featured' => $data['featured'],
        //     ]);
        // }
        //get images from the request and send it to saveImage() of ImageController class
        $images = $request->file('files');
        $imageContr = new ImageController();
        $response = $imageContr->saveImage($images, $this->productId, $request->featuredImage);
        
        Session::flash('success', "Product created");

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $product = Product::find($id);
        // $updateData = $this->serializeToArray($request);
        // dd($updateData);
        // if (!Gate::allows('product-edit')) {
        //     return abort(401);
        // }
        //check if the HTTP post request contains image or not
        if($request->data != null){
            $updateData = $this->serializeToArray($request);
            $product->name = $updateData['name'];
            $product->slug = str_slug($updateData['name']);
            $product->price = $updateData['price'];
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->save();

            Session::flash('success', 'Product Updated Successfully!!!');

            return redirect()->back();

        }else{
            $product->update($request->all());

            $product->slug = str_slug($request->name);
            $product->save();
            $images = $request->file('files');
            $imageContr = new ImageController();
            $response = $imageContr->saveImage($images, $id, $request->featuredImage);

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
        Product::find($id)->delete();
        return redirect()->back();
    }

    public function status(Request $request){
        if($request->has('status')){
            $product = Product::where('id', $request->productId)->first();
            $product->status = $request->status;
            $product->save();
        }elseif($request->has('featured')){
            // dd($request->productId);
            $product = Product::where('id', $request->productId)->first();
            $product->featured = $request->featured;
            $product->save();
        }
    }
    
    /**
     * Change serialized data into an array
     */
    private function serializeToArray($data){
        $newData = array();
        parse_str($data->data, $newData);
        return $newData;
    }
}

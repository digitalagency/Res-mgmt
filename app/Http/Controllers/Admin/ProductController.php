<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Gate::allows('category-view')){
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
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required',
            'featured' => 'required',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasfile('image'))
         {
            foreach($request->file('image') as $img)
            {
                $name=time().$img->getClientOriginalName();
                $img->move(public_path().'/images/', $name);  
                $data[] = $name;  
            }
            $product = new Product();
            // $product->image = json_encode($data);

            Product::create([
            'category_id' => $request->category_id,
            'slug' =>str_slug($request->name),
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'featured' => $request->featured,
            'image' => json_encode($data)
            ]);
           
        }

        Session::flash('success', "Product created");

        // dd($request->all());
        
        return redirect()->route('product.index');
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
        return view('admin.product.edit')->with('product',Product::find($id))
                                         ->with('categories', Category::all());
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
        // dd($request->all());
        // if($request->hasfile('image'))
        // {
        //     foreach($request->file('image') as $img)
        //     {
        //         $name=time().$img->getClientOriginalName();
        //         $img->move(public_path().'/images/', $name);  
        //         $data[] = $name;  
        //     }
        //     Product::find($id)->update($request->all());
        // }

        Product::find($id)->update($request->all());

        Session::flash('success', 'Product changed');

        return redirect()->route('product.index');
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
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
// use App\Models\Admin\Category;
use Session;

use App\Models\Admin\Category;

class CategoryController extends Controller
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

        return view('admin.category.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       if (!Gate::allows('category-add')) {
            return abort(401);
        }
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('employee-add')) {
            return abort(401);
        }
        $this->validate($request, [
            'name' => 'required',
        ]);

        Category::create([

            'name' => $request->name,
            'slug' =>str_slug($request->name),
            'parent_id' => $request->parent_id,

        ]);
        Session::flash('success', "Category Created Successfully");
        return redirect()->route('category.index');

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
        if (!Gate::allows('category-edit')) {
            return abort(401);
        }
        return view('admin.category.edit')->with('category',Category::find($id));
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
        if (!Gate::allows('category-edit')) {
            return abort(401);
        }
        // dd($request->all());
        Category::find($id)->update($request->all());

        Session::flash('success', 'Category changed');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('category-delete')){
            return abort(401);
        }
        Category::find($id)->delete();
        return redirect()->back();
        
    }
}

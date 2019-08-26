<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use Session;

use App\Models\Admin\Header;

class ProfileHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Gate::allows('header-view')){
            return abort(401);
        }

        return view('admin.profileHeader.index')->with('headers', Header::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('header-add')) {
            return abort(401);
        }
        return view('admin.profileHeader.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('header-add')) {
            return abort(401);
        }
        $this->validate($request, [
            'title' => 'required',
            'contact' => 'required',

            ]);
        Header::create([

            'title' => $request->title,
            'contact' => $request->contact,

        ]);

        Session::flash('Successful', "Header Content Created Successfully");
        return redirect()->route('profileHeader.index');
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

        if (!Gate::allows('header-edit')) {
            return abort(401);
        }
        return view('admin.profileHeader.edit')->with('headers',Header::find($id));
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
        if (!Gate::allows('header-edit')) {
            return abort(401);
        }
        // dd($request->all());
        Header::find($id)->update($request->all());

        Session::flash('success', 'Header Content changed');

        return redirect()->route('profileHeader.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Gate::allows('header-delete')){
            return abort(401);
        }
        Header::find($id)->delete();
        return redirect()->back();
    }
}

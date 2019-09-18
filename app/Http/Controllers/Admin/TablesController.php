<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Table;
use Session;

class TablesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Gate::allows('table-view')){
            return abort(401);
        }
        return view('admin.tables.index')->with('tables', Table::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(! Gate::allows('table-add')){
            return abort(401);
        }
        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('table-add')) {
            return abort(401);
        }
        $this->validate($request, [
            'table_no' => 'required|max:10',
            'capacity' => 'required|max:2'
        ]);
        Table::create($request->all());

        Session::flash('success', 'Table added Successfully!!!');

        return redirect()->back();
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
        if (!Gate::allows('table-edit')) {
            return abort(401);
        }
        return view('admin.tables.edit')->with('table', Table::findOrFail($id));
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
        if (!Gate::allows('table-edit')) {
            return abort(401);
        }
        $this->validate($request, [
            'table_no' => 'required|max:10',
            'capacity' => 'required|max:2'
        ]);
        $table = Table::findOrFail($id);
        $table->update($request->all());

        Session::flash('success', 'Table Updated Successfully!!!');

        return redirect()->route('table.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('table-delete')) {
            return abort(401);
        }
        Table::findOrFail($id)->delete();
        Session::flash('success', 'Table Deleted Successfully!!!');
        return redirect()->back();
    }
}

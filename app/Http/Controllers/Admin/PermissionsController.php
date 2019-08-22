<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Permission;
use Session;
use App\Models\Admin\PermissionComponent;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Gate::allows('permission-view')){
            return abort(401);
        }
        return view('admin.permissions.index')->with('permissions', Permission::all())
                                                ->with('p_components', PermissionComponent::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('permission-add')) {
            return abort(401);
        }
        return view('admin.permissions.create')->with('p_components', PermissionComponent::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('permission-add')) {
            return abort(401);
        }
        $this->validate($request,[
            'permission' =>'required'
        ]);
        $permission = str_slug($request->permission);
        Permission::create([
            'permission' => $permission,
            'p_component_id' => $request->component
        ]);

        Session::flash('success', 'Permission Updated Successfully!!!');
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
        if (!Gate::allows('permission-edit')) {
            return abort(401);
        }
        $permission = Permission::find($id);

        return view('admin.permissions.edit')->with('permission', $permission)
                                                ->with('p_components', PermissionComponent::all());
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
        if (!Gate::allows('permission-edit')) {
            return abort(401);
        }
        $permission = Permission::find($id);
        $permission->permission = str_slug($request->permission);
        $permission->p_component_id = $request->component;
        $permission->save();
        
        Session::flash('success', 'Permission Updated Successfully!!!');
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('permission-delete')) {
            return abort(401);
        }
        Permission::find($id)->delete();
        return redirect()->route('permission.index');
    }

    public function trashed()
    {
        if (!Gate::allows('permission-view')) {
            return abort(401);
        }
        $permissions = Permission::onlyTrashed()->get();

        return view('admin.permissions.trashed')->with('permissions', $permissions);
    }

    public function killTrashed($id)
    {
        if (!Gate::allows('permission-view')) {
            return abort(401);
        }
        Permission::withTrashed()->where('id', $id)->first()->forceDelete();

        Session::flash('success', 'Permission Permanently Deleted!!!');
        return redirect()->back();
    }

    public function restoreTrashed($id)
    {
        if (!Gate::allows('permission-view')) {
            return abort(401);
        }
        Permission::withTrashed()->where('id', $id)->first()->restore();

        Session::flash('success', 'Permission restored successfully!!!');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin\Role;
use App\Models\Admin\Permission;
use App\Models\Admin\PermissionComponent;
use Session;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Gate::allows('role-view')){
            return abort(401);
        }
        return view('admin.roles.index')->with('roles', Role::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('role-add')) {
            return abort(401);
        }
        return view('admin.roles.create')->with('permissions', Permission::all())
                                            ->with('p_components', PermissionComponent::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('role-add')) {
            return abort(401);
        }
        $this->validate($request, [
            'role' => 'required'
        ]);
        $role = Role::create($request->all());
        $role->permissions()->sync($request->permission);

        Session::flash('success', 'Role Created Successfully!!!');

        return redirect()->route('role.index');
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
        if (!Gate::allows('role-edit')) {
            return abort(401);
        }
        return view('admin.roles.edit')->with('role', Role::findOrFail($id))
                ->with('permissions', Permission::all())
                ->with('p_components', PermissionComponent::all());;
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
        if (!Gate::allows('role-edit')) {
            return abort(401);
        }
        $role = Role::findOrFail($id);
        $role->update($request->all());
        $role->permissions()->sync(array_filter((array) $request->permission));

        Session::flash('success', 'Role Updated Successfully!!!');

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('role-delete')) {
            return abort(401);
        }
        Role::find($id)->delete();
        return view('admin.roles.index');
    }
}

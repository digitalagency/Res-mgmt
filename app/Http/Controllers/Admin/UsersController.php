<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Hash;
use App\User;
use App\Models\Admin\Role;
use Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('employee-view')){
            return abort(401);
        }
        return view('admin.users.index')->with('users', User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('employee-add')) {
            return abort(401);
        }
        return view('admin.users.create')->with('roles', Role::all());
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
            'name' => 'required|max:200',
            'email' => 'required|email|max:250',
            'password' => 'required|min:8'
        ]);
        $password = Hash::make($request->password);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => $password,

        ]);
        Session::flash('success', "Employee Created Successfully");

        return redirect()->route('employee.index');
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
        if (!Gate::allows('employee-edit')) {
            return abort(401);
        }
        return view('admin.users.edit')->with('user', User::find($id))
                                        ->with('roles', Role::all());
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
        if (!Gate::allows('employee-edit')) {
            return abort(401);
        }
        User::find($id)->update($request->all());

        Session::flash('success', 'Employee Updated Successfully!!!');

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('employee-delete')) {
            return abort(401);
        }
        User::find($id)->delete();

        Session::flash('success', "User Deleted Successfully!!!");
        return redirect()->back();
    }
}

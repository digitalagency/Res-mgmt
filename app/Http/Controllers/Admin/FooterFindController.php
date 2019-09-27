<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use Session;
use App\Models\Admin\FindReservation;
use App\Models\Admin\SocialMediaLinks;
use App\Models\Admin\Schedule;
use Validator;

class FooterFindController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(! Gate::allows('find-reserve-view')){
            return abort(401);
        }

        return view('admin.footerFind.index')->with('reserves',FindReservation::all())
                                            ->with('schedules',Schedule::all())
                                            ->with('medias',SocialMediaLinks::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows('find-reserve-add')) {
            return abort(401);
        }
        $reserves = new FindReservation();
        return view('admin.footerFind.create', $reserves)->with('reserves', $reserves);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Gate::allows('find-reserve-add'))
        {

            $this->validate($request, [
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:250',
            'viber' => 'required|max:10',
        ]);

        FindReservation::create([

            'address' => $request->address,
            'email' => $request->email,
            'viber' => $request->viber,

        ]);
        Session::flash('success', "Footer Content Created Successfully");
        return redirect()->route('footerFind.index');
        }
        else
        {
            return abort(401);
        }


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
        if(Gate::allows('find-reserve-edit'))
        {
            $reserves = FindReservation::find($id);
            return view('admin.footerFind.create',$reserves)->with('reserves',$reserves);
        }
        else
        {
            return abort(401);
        }
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
        if(Gate::allows('find-reserve-edit')){
            FindReservation::find($request->id)->update($request->all());
            Session::flash('Updated','Reservation updated!');

            return redirect()->route('footerFind.index');
        }
        else{
            return abort(401);
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
        if(Gate::allows('find-reserve-delete'))
        {
            FindReservation::find($id)->delete();
            return redirect()->back();
        }
        else{
            return abort(401);
        }
    }
}

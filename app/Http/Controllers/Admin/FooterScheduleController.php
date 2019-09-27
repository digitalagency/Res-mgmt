<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use Session;
use App\Models\Admin\Schedule;
use App\Models\Admin\FindReservation;

class FooterScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::allows('schedule-add'))
        {
            $this->validate($request, [

                'close_day' => 'required',
                'open_day_1' => 'required',
                'first_open_from' => 'required',
                'first_open_to' => 'required',
                'open_day_2' => 'required',
                'second_open_from' => 'required',
                'second_open_to' => 'required',
            ]);

            Schedule::create([

                'close_day' => $request->close_day,
                'open_day_1' => $request->open_day_1,
                'first_open_from' => $request->first_open_from,
                'first_open_to' => $request->first_open_to,
                'open_day_2' => $request->open_day_2,
                'second_open_from' => $request->second_open_from,
                'second_open_to' => $request->second_open_to,

            ]);

            Session::flash('success', "Schedule Content Created Successfully!");
            return redirect()->route('footerFind.index');
        }
        else{
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
        if(Gate::allows('schedule-edit')){
            
            $schedule = Schedule::find($id);
            return view('admin.footerFind.scheduleEdit')->with('schedule', $schedule);                                       
        }
        else{
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
        if(Gate::allows('schedule-edit')){
            Schedule::find($id)->update($request->all());
            Session::flash('Updated','Schedule updated!');

            return redirect()->route('footerFind.index');
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
        if(Gate::allows('schedule-delete')){
            Schedule::find($id)->delete();
            return redirect()->back();
        }
        else{
            return abort(401);
        }
    }
}

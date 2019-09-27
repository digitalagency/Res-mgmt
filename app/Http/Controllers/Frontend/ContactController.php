<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Models\Frontend\Contact;
use App\Models\Admin\FindReservation;
use App\Models\Admin\Header;
use App\Models\Admin\Schedule;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use DB;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = FindReservation::select()->first();
        $contact = Header::select()->first();
        $schedules = Schedule::select()->first();
        return view('frontend.contact')->with('contacts', $contacts)
                                        ->with('contact', $contact)
                                        ->with('schedules', $schedules);
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
        $this->validate($request,[
            'fullName' => 'required',
            'email' => 'required|email|max:250',
            'message' => 'required',
            'budgetLevel' => 'required',

        ]);
        Contact::create($request->all());
        $data= array(

            'fullName' => $request->fullName,
            'message' => $request->message,
            'contact' => $request->contact,
            'budgetLevel' => $request->budgetLevel
        );
        Mail::to('admin@admin.com')->send(new SendMail($data));
        Session::flash('Success', "Contact Information Saved");
        return redirect()->route('contact.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

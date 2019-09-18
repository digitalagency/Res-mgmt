<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Session;

use App\Models\Frontend\Contact;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('message-view')){
            $messages = Contact::all();
            return view('admin.messages.index')->with('messages', $messages );
        }
        else{
            return abort(401);
        }
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
        //
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
        if(Gate::allows('message-delete')){
            Contact::find($id)->delete();
            return redirect()->back();
        }
        else{
            return abort(401);
        }
    }


    public function trashed(){
        if(Gate::allows('message-view')){
            $messages = Contact::onlyTrashed()->get();
            return view('admin.messages.trashed')->with('messages', $messages);
        }
        else{
            return abort(401);
        }
    }


    public function killTrashed($id){
        if(Gate::allows('message-view')){
            Contact::withTrashed()->where('id',$id)->first()->forceDelete();
            Session::flash('success', 'Message deleted successfully');
            return redirect()->back();
        }
        else{
            return abort(401);
        }
    }

    public function restoreTrashed($id){
        if(Gate::allows('message-view')){
            Contact::withTrashed()->where('id', $id)->first()->restore();
            Session::flash('success', 'Message restored again');

            return redirect()->back();
        }
        else{
            return abort(401);
        }
    }
}

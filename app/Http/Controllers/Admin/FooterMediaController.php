<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Gate;

use Session;
use App\Models\Admin\SocialMediaLinks;

class FooterMediaController extends Controller
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
        if(Gate::allows('media-add'))
        {
            $this->validate($request, [

                'facebook' => 'url',
                'instagram' => 'url',
                'twitter' => 'url',
                'linkedIn' => 'url',
                'google' => 'url',
    
            ]);

            SocialMediaLinks::create([

                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'twitter' => $request->twitter,
                'linkedIn' => $request->linkedIn,
                'google' => $request->google,

            ]);

            Session::flash('success', "Footer Content Created Successfully");
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
        if(Gate::allows('media-edit'))
        {
            $medias = SocialMediaLinks::find($id);
            return view('admin.footerFind.mediaEdit',$medias)->with('medias',$medias);
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
        if(Gate::allows('media-edit')){
            SocialMediaLinks::find($id)->update($request->all());
            Session::flash('Updated','Media updated!');

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
        if(Gate::allows('media-delete'))
        {
            SocialMediaLinks::find($id)->delete();
            
            return redirect()->back();
        }
        else
        {
            return abort(401);
        }
    }
}

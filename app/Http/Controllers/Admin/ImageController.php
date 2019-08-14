<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function store(Request $request){

    	$imageName = time().$request->file->getClientOriginalName();
        $request->file->move(public_path('upload'),$imageName);
        return response()->json(['uploaded' => 'upload'.$imageName]);
        
    }
}

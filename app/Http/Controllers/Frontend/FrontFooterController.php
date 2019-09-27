<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\FindReservation;
use App\Models\Admin\Header;

class FrontFooterController extends Controller
{
	$contacts = FindReservation::select()->first();
	$contact = Header::select()->first();
	$schedules = Schedule::select()->first();
    return view('frontend.includes.footer')->with('contacts', $contacts)
    										->with('contact',$contact)
    										->with('schedule',$schedules);
}

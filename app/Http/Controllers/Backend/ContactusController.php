<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DB;
/**
 * Class ContactusController
 * @package App\Http\Controllers\Backend
 */
class ContactusController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.dashboard');
    }

/* contactus start..*/
public function contactUs()
{ 
	$contact_us=DB::table('contactus')->get();
	return view('backend.contact.contactus',compact('contact_us')); 
}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use DB;

/**
 * Class Controller
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
	
	}
	
	public function getcanton()
	{
		$canton = array('canton1'=>'canton1','canton2'=>'canton2')	;
		return $canton;
		
	} 
	public function getcountry()
	{
		$country = DB::table('countries')->get();
		return $country;
		
	} 
	public function getAge()
	{
		$age = range(18,60);		
		return $age;
		
	}
}
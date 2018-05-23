<?php


namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;


use DB,Session,Auth;


/**
 * Class BookingController.
 */
class CalendarController extends Controller
{
	public function index()
    {
    	session_start();
    	$old_date='';
    	if(!empty($_SESSION) && isset($_SESSION['date']))
    	{
    		$old_date = $_SESSION['date'];
    		session_unset($_SESSION);
    	}
    	
			//print_r($date_ex);
			 $sel_date=date('Y-m-d');
			//echo $_REQUEST['booking_date'];
			 $booking_date=$sel_date;
			$user_id=Auth::id();
			$cond=array('bookings.profile_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','ASC')->get();
			//echo "<pre>"; print_r($booked_data_arr); die;
			

			$con = array('user_id' => Auth::User()->id, 'date' => $sel_date);
			$user_info1='';
			//$user_info1 = DB::table('user_prices')->select('rate_15m','rate_30m','rate_1h','rate_1d')->where($con)->first();
			if(!empty($user_info1))
			{
				$user_info = $user_info1;
			}
			else
			{
				$con_arr=array('users.id'=>$user_id);
				$user_info =DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->select('rate_15m','rate_30m','rate_1h','rate_1d')->where($con_arr)->first();		
			}
			$blockDate = array();
			$block_Date = DB::table('user_prices')->where('user_id',Auth::User()->id)->where('status', 'Block')->get();
			$blockDate= array();
			foreach ($block_Date as $key => $value) {
				$blockDate[] = date('m-d-Y', strtotime($value->date));
			}

		return view('frontend.calendar.calenderview',compact('booked_data_arr','sel_date','user_info','blockDate'));
    }
	public function getBooking()
    {
    	session_start();
    	$old_date='';
    	if(!empty($_SESSION) && isset($_SESSION['date']))
    	{
    		$old_date = $_SESSION['date'];
    		session_unset($_SESSION);
    	}
    	
		$sel_date=date('Y-m-d');
		$booking_date=$sel_date;
		$user_id=Auth::id();
		$user_type = Auth::User()->user_type;
		if(Auth::User()->user_type == 'Escort')
		{
			$cond=array('bookings.profile_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->skip(0)->take(5)->get();
			$upcoming_booking_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
		}
		else
		{
			$cond=array('bookings.user_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
				$upcoming_booking_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->skip(0)->take(5)->get();
		}
		/*echo "<pre>"; print_r($booked_data_arr);
		echo "<pre>"; print_r($upcoming_booking_arr); die;*/
		//echo $user_type; exit;
		$totals=count($upcoming_booking_arrtot);
		return view('frontend.booking.booking',compact('booked_data_arr','sel_date', 'upcoming_booking_arr', 'user_type','totals'));
    }
    public function getfilterbooks()
    {
    	$skipreco = $_REQUEST['group_no'];
         $position = ($skipreco * 5);
    	session_start();
    	$old_date='';
    	if(!empty($_SESSION) && isset($_SESSION['date']))
    	{
    		$old_date = $_SESSION['date'];
    		session_unset($_SESSION);
    	}
    	
		$sel_date=date('Y-m-d');
		$booking_date=$sel_date;
		$user_id=Auth::id();
		$user_type = Auth::User()->user_type;
		if(Auth::User()->user_type == 'Escort')
		{
			$cond=array('bookings.profile_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->skip($position)->take(5)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->skip($position)->take(5)->get();
			$upcoming_booking_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
		}
		else
		{
			$cond=array('bookings.user_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->skip($position)->take(5)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->skip($position)->take(5)->get();
			$upcoming_booking_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
		}
		/*echo "<pre>"; print_r($booked_data_arr);
		echo "<pre>"; print_r($upcoming_booking_arr); die;*/
		$totals=count($upcoming_booking_arrtot);
		return view('frontend.booking.filterbooking',compact('booked_data_arr','sel_date', 'upcoming_booking_arr', 'user_type','totals'));
    }
    public function getBookingup()
    {
    	session_start();
    	$old_date='';
    	if(!empty($_SESSION) && isset($_SESSION['date']))
    	{
    		$old_date = $_SESSION['date'];
    		session_unset($_SESSION);
    	}
    	
		$sel_date=date('Y-m-d');
		$booking_date=$sel_date;
		$user_id=Auth::id();
		$user_type = Auth::User()->user_type;
		if(Auth::User()->user_type == 'Escort')
		{
			$cond=array('bookings.profile_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->skip(0)->take(5)->get();
			$booked_data_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
		}
		else
		{
			$cond=array('bookings.user_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->skip(0)->take(5)->get();
			$booked_data_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
			$upcoming_booking_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
		}
		/*echo "<pre>"; print_r($booked_data_arr);
		echo "<pre>"; print_r($upcoming_booking_arr); die;*/
		 $totals=count($booked_data_arrtot);
		return view('frontend.booking.booking2',compact('booked_data_arr','sel_date', 'upcoming_booking_arr', 'user_type','totals'));
    }
     public function getfilterupcomingbook()
    {
    	 $skipreco = $_REQUEST['group_no'];
         $position = ($skipreco * 5);
    	session_start();
    	$old_date='';
    	if(!empty($_SESSION) && isset($_SESSION['date']))
    	{
    		$old_date = $_SESSION['date'];
    		session_unset($_SESSION);
    	}
    	
		$sel_date=date('Y-m-d');
		$booking_date=$sel_date;
		$user_id=Auth::id();
		$user_type = Auth::User()->user_type;
		if(Auth::User()->user_type == 'Escort')
		{
			$cond=array('bookings.profile_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->skip($position)->take(5)->get();
			$booked_data_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->skip($position)->take(5)->get();
		}
		else
		{
			$cond=array('bookings.user_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->skip($position)->take(5)->get();
			$booked_data_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','<=',$booking_date)->get();
			$upcoming_booking_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->skip($position)->take(5)->get();
			$upcoming_booking_arrtot=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '>', $sel_date)->orderBy('bookings.book_date','DESC')->where('bookings.book_date','>=',$booking_date)->get();
		}
		/*echo "<pre>"; print_r($booked_data_arr);
		echo "<pre>"; print_r($upcoming_booking_arr); die;*/
		 $totals=count($booked_data_arrtot);
		return view('frontend.booking.filterbooking2',compact('booked_data_arr','sel_date', 'upcoming_booking_arr', 'user_type','totals'));
    }
    public function getShowEscortPrice()
    {
    	$ctrl = $_REQUEST['ctrl'];
    	//echo $ctrl; exit;
		$date = explode('-', $_REQUEST['booking_date']);
		//echo "<pre>"; print_r($date); die;
		//return $date;
        $date1 =  $date[2].'-'.$date[0].'-'.$date[1];
        $data = array();


        session_start();
        //session_unset('data');
        if($ctrl == 'ctrl_true')
        {
	        $old_date='';
	        if(!empty($_SESSION['date']))
	        {
	        	$old_date = $_SESSION['date'];
	        }
	        $checkdtae= array();
	        if(!empty($old_date))
	        {
	        	$old_date = rtrim($old_date,',');
	        	$checkdtae = explode(',', $old_date);
	        }

	        if(in_array($_REQUEST['booking_date'], $checkdtae))
	        {
	        	$checkdate = array_diff($checkdtae, array($_REQUEST['booking_date']));
	        	$_SESSION['date'] = implode(',', $checkdate);
	        	$data['result'] = 'false';
	        }
	        else
	        {
	        	if(empty($old_date))
	        	{
	        		$_SESSION['date'] = $_REQUEST['booking_date'];	
	        	}
	        	else
	        	{
	        		$_SESSION['date'] = $old_date.",".$_REQUEST['booking_date']
	        		;
	        	}
	        	$data['result'] = 'true';
	        }
	    }
	    else
	    {
	    	session_unset('data');
	    	$_SESSION['date'] = $_REQUEST['booking_date'];
	    	$data['result'] = 'true';
	    }
        $data['select_date'] = $_SESSION['date'];



		$con = array('user_id' => Auth::User()->id, 'date' => $date1);
		$user_info1 = DB::table('user_prices')->select('rate_15m','rate_30m','rate_1h','rate_1d','status')->where($con)->first();
		$user_block= '';
		if(!empty($user_info1))
		{
			$block = $user_info1->status;
			if($block == 'Block')
			{
				$user_block = "true";
			}
			$user_info = $user_info1;
		}
		else
		{
			$con_arr=array('users.id'=>Auth::User()->id);
			$user_info =DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->select('rate_15m','rate_30m','rate_1h','rate_1d')->where($con_arr)->first();		
		}
		/*$data = '<p>15 MINS :<input class="mins" type="text" name="15m" value="'.$user_info->rate_15m.'" ></p><p>30 MINS :<input class="minss" type="text" name="30m" value="'.$user_info->rate_30m.'" ></p><p>1 HR:<input class="mins-hr" type="text" name="1hr" value="'.$user_info->rate_1h.'" ></p><p>24 HR:<input class="mins-hrr" type="text" name="1d" value="'.$user_info->rate_1d.'" >'; 
		//echo "<pre>"; print_r($user_info); die;
		return $data;*/
		
		$data['html'] = '<div class="booking-rate">
					<p><span>15 MINS :</span><input class="mins" type="text" name="15m" id="15m" value="'.$user_info->rate_15m.'" ></p>
					<p><span>30 MINS :</span><input class="minss" type="text" name="30m" id="30m" value="'.$user_info->rate_30m.'" ></p>
					<p><span>1 HR:</span><input class="mins-hr" type="text" name="1hr" id="1hr" value="'.$user_info->rate_1h.'" ></p>
					<p><span>24 HR:</span><input class="mins-hrr" type="text" name="1d" id="1d" value="'.$user_info->rate_1d.'" ></p>
				</div>
				<div class="report-submit manage_model">
					<button class="btn save_btn" type="button" onclick="changePrice();">Save</button>
					<button class="btn save_btn" type="button" id="dateStatus" ';
				if(!empty($user_block))
				{
					$data['html'].=' onclick=chnageBookingStatus("UnBlock");>UnBlock';
				}
				else
				{
					$data['html'].=' onclick=chnageBookingStatus("Block");>Block';
				}
		$data['html'].='</button>
				</div>';

		return $data;


    }

    public function getCheckBookingStatus()
    {
    	
    	$id = $_REQUEST['id'];
    	$date_arr = explode(',',$_REQUEST['date']);
    	foreach ($date_arr as $key => $value) {
    		$date = explode('-', $value);
	        $date1 =  $date[2].'-'.$date[0].'-'.$date[1];
	    	$con = array('user_id' => $id, 'date' => $date1);
			$user_info1 = DB::table('user_prices')->where($con)->first();
			if(!empty($user_info1))
			{
				$update_arr = array('status' => $_REQUEST['status']);
				DB::table('user_prices')->where('id',$user_info1->id)->update($update_arr);
			}
			else
			{
				$user_arr = DB::table('user_informations')->where('user_id',$id)->first();
				$insert_arr = array('user_id' =>$id, 'date' => $date1, 'rate_15m' => $user_arr->rate_15m, 'rate_30m' => $user_arr->rate_30m, 'rate_1h' => $user_arr->rate_1h, 'rate_1d' => $user_arr->rate_1d, 'status' =>$_REQUEST['status']);
				//echo "<pre>"; print_r($insert_arr); die;
				DB::table('user_prices')->insert($insert_arr);
			}
		}
		/*if($_REQUEST['status'] == 'UnBlock'){
			$data = '<button class="btn save_btn" onclick=chnageBookingStatus("Block"); type="button">Block</button>';
		}
		else {
			$data = '<button class="btn save_btn" onclick=chnageBookingStatus("UnBlock"); type="button">UnBlock</button>';
		}*/
		$data['status'] =$_REQUEST['status'];
		$data['date_arr'] =$date_arr;
		return $data;
    }
}

?>
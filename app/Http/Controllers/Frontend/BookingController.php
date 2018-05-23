<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use DB, Auth, View, Response, Redirect;
use Illuminate\Support\Facades\Input;
use App\Booking;
use App\UserUnavailabilityDates;
use Illuminate\Support\Facades\Mail;
/**
 * Class BookingController.
 */
class BookingController extends Controller
{
	public function index()
    {
		
    }

    public function getAvailability()
	{
		$availability = DB::table('available_time_slot_master')->whereRaw("is_active='Y'")->get();

		$list_unavaible = DB::table('user_availability_dates')
						->join('available_time_slot_master','available_time_slot_master.id','=','user_availability_dates.available_time_slot_id')
						->whereRaw("user_id='".Auth::id()."'")
						//->groupBy('date')
						->orderBy('date','ASC')
						->select('user_availability_dates.*','available_time_slot_master.start_time','available_time_slot_master.end_time')
						->get();
	// echo "<pre>";print_r($list_unavaible);die;
	 
	 //echo "<pre>";print_r($availability);die;
		return view('frontend.booking.availability')
					->with('availability', $availability)
					->with('unavailability', $list_unavaible)
					->withUser(auth()->user());
	}
	
	public function getDateWiseAvailability($seldate=NULL)
	{
		list($mm,$dd,$yy) = explode('-',$seldate);
		$filterdate = $yy.'-'.$mm.'-'.$dd;
		$un_availability_arr = DB::table('available_time_slot_master')
						->leftJoin('user_availability_dates', 'user_availability_dates.available_time_slot_id', '=', 'available_time_slot_master.id')
						->selectRaw('group_concat(available_time_slot_master.id) as unavailable_slot_ids')
						->whereRaw("available_time_slot_master.is_active='Y' AND user_availability_dates.date='".$filterdate."' AND user_availability_dates.user_id='".Auth::id()."'")->first();

		if(count($un_availability_arr) > 0){
			$unavailability_slots_arr = explode(',',$un_availability_arr->unavailable_slot_ids);
		}else{
			$unavailability_slots_arr = array('0');
		}		
		
		$availability_arr = DB::table('available_time_slot_master')->whereRaw("is_active='Y'")->get();

		//echo "<pre>"; print_r($unavailability_slots_arr); 
		//echo "<pre>"; print_r($availability_arr); 
		//die;
		
		$i=0;
		$availability_final_arr = array();

		foreach($availability_arr as $kk){
					$availability_final_arr[$i]['id'] = $kk->id;
					$availability_final_arr[$i]['start_time'] = $kk->start_time;
					$availability_final_arr[$i]['end_time'] = $kk->end_time;

				if (in_array($kk->id, $unavailability_slots_arr)) {		
					//echo $kk->id."<br>if";

					$availability_final_arr[$i]['available'] = 'no';

				}else{
					//echo $kk->id."<br>else";	
					$availability_final_arr[$i]['available'] = 'yes';

				}
			$i++;
		}
		//echo "<pre>"; print_r($availability_final_arr); 
		//die;
		return view('frontend.booking.selected_availability')
					->with('availability_final_arr', $availability_final_arr)
					->with('unavailability_slots_arr', $unavailability_slots_arr);
	}
	
    public function postSetAvail()
	{
		$input = Input::all();
		list($mm,$dd,$yy) = explode('-',$input['datetime']);
		$filterdate = $yy.'-'.$mm.'-'.$dd;
		$datetime = $filterdate; 
		
		
			if ( Input::has('slot_id') ){
				
					$all_slot = DB::table('available_time_slot_master')
											->whereRaw("1=1") 
											->whereIn('id', $input['slot_id'])
											->lists('id');
					$already_set_record = DB::table('user_availability_dates')
											->where('user_id', '=', Auth::id())
											->whereRaw("date='".$datetime."'")
											->get();
					if( count($already_set_record) > 0){
							foreach ($already_set_record as $key =>$slot_id) {
								$slot_rec = UserUnavailabilityDates::where('date',$datetime)->find($slot_id->id)->delete();	
							}
						}
		
					foreach ($all_slot as $key => $slot_id) {
						$UnavAilability = new UserUnavailabilityDates;
						$UnavAilability->user_id = Auth::id();
						$UnavAilability->date 	 = $datetime;
						$UnavAilability->available_time_slot_id = $slot_id;
						$UnavAilability->is_active = 'Y';
						$UnavAilability->save();		
					}
			}else{

				/*$all_slot = DB::table('available_time_slot_master')
											->whereRaw("1=1") 
											->lists('id');*/
				$already_set_record = DB::table('user_availability_dates')
											->where('user_id', '=', Auth::id())
											->whereRaw("date='".$datetime."'")
											->get();
				if( count($already_set_record) > 0){
						foreach ($already_set_record as $key =>$slot_id) {
							$slot_rec = UserUnavailabilityDates::where('date',$datetime)->find($slot_id->id)->delete();	
						}
					}
				/*foreach ($all_slot as $key => $slot_id) {
						
						$UnavAilability = new UserUnavailabilityDates;
						$UnavAilability->user_id = Auth::id();
						$UnavAilability->date 	 = $datetime;
						$UnavAilability->available_time_slot_id = $slot_id;
						$UnavAilability->is_active = 'Y';
						$UnavAilability->save();		
					}*/
			}
	
		
			return Redirect::back()->withFlashSuccess('Ailability successfully set!');
	}

	public function getTimeSlot()
	{
		$date = $_REQUEST['date'];

		$unavail_day_slot['slot_id'] = DB::table('user_availability_dates')
						->whereRaw("date='".$date."'")->lists('available_time_slot_id');
			
		$already_set_record = DB::table('available_time_slot_master')
									->whereRaw("1=1")
									->whereNotIn('id', $unavail_day_slot['slot_id'])
									->orderBy('id', 'ASC')
									->get();
		return view('frontend.user.timeslot')->withUser(auth()->user())->with('timeslot', $already_set_record);
	}

	public function deleteUnAvail($id=NULL)
	{
		$slot_rec = UserUnavailabilityDates::find($id);		
		if(count($slot_rec) > 0){
			$slot_rec->delete();
			return Redirect::back()
					->withFlashSuccess('<i>unavail slot deleted successfully.</i>');
		}
	}

	public function bookingConfirm($confirmation_code = NULL)
	{
		$booking_arr = Booking::whereRaw("confirmation_code='".$confirmation_code."'")->first();
		$user = User::findOrFail($booking_arr->user_id);
		if(count($booking_arr) > 0){
			$Booking = Booking::find($booking_arr->id);
			$Booking->id = $booking_arr->id;
			$Booking->confirmation_code = md5(uniqid(mt_rand(), true));
			$Booking->invitation_accepted = 'Y';
			$Booking->is_active = 'Y';
			$Booking->save();

			Mail::send('emails.welcome_booking_accept', ['data' => $Booking], function ($m) use ($user) {
             	 $m->to($user->email, $user->name)->subject('Received a message for booking accepted..');
             	});
			return Redirect::back()->withFlashSuccess('Booking request successfully confirm!');
		}else{
			return view('frontend.booking.booking_list')->withErrors('Booking Invitation url expired or wrong. Please try again.');
		}
	}

	public function getBookingRequestDelete($id=NULL)
	{
		$booking = Booking::find($id);		
		if(count($booking) > 0){
			$booking->delete();
			return redirect('user/booking')
					->withFlashSuccess('Booking request successfully deleted!');
		}
	}

	public function getBookingDetails($id)
	{
		$booking = Booking::whereRaw("id='".$id."'")->first();
		if($booking->user_id == Auth::id() ){
				return view('frontend.booking.outgoing_detail')
				->with('booking',$booking);
		}
		return view('frontend.booking.detail')
				->with('booking',$booking);
	}

	public function getBookedmember()
	{
		if(isset($_REQUEST['booking_date']) && $_REQUEST['booking_date']!="")
		{
			$date_ex=explode('-', $_REQUEST['booking_date']);
			//print_r($date_ex);
			 $sel_date=$date_ex[2].'-'.$date_ex[0].'-'.$date_ex[1];
			//echo $_REQUEST['booking_date'];
			 $booking_date=$sel_date;
			$user_id=Auth::id();
			$cond=array('bookings.book_date'=>$booking_date,'bookings.profile_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo','ats.start_time','ats.end_time')->join('available_time_slot_master as ats', 'ats.id', '=', 'bookings.time_sloat_id')->
			join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->get();
			echo view('frontend.calendar.calenderusers_ajax',compact('booked_data_arr',"sel_date"));
		}
	}
	public function changeBookStatus()
	{
		//echo '<pre>'; print_r($_REQUEST); die;
		if(isset($_REQUEST['bkid']) && $_REQUEST['bkid']!="" && isset($_REQUEST['bkstatus']) && $_REQUEST['bkstatus']!="")
		{
			//echo '<pre>'; print_r($_REQUEST['bkid']); die;

			$up_arr=array('invitation_accepted'=>$_REQUEST['bkstatus']);
			DB::table('bookings')->where('id',$_REQUEST['bkid'])->update($up_arr);
			$book_arr=DB::table('bookings')->where('id',$_REQUEST['bkid'])->first();
						$str=array();
			$str['time_sloat_id'] = $book_arr->time_sloat_id;
			$str['action'] = '';
			$book = DB::table('bookings')->where('id', $_REQUEST['bkid'])->first();
			$user = DB::table('users')->where('id',$book->user_id)->first();
			$escort = DB::table('users')->where('id',$book->profile_id)->first();
			$titleclient = "Booking confirmed";
			$statusbookconfm = "Confirmed";
			$titlebookescort = "Booking Confirmed for @".$user->name;
			$phone = $escort->phone;



			$status = "Declined";
			$title = "Booking Declined";
			$titleescort = "Booking declined for @".$user->name;
			

			if($book_arr->invitation_accepted=='Y'){
				Mail::send('frontend.auth.emails.clientbookaccept',['nameescort' => $escort->name,'date' => $book->book_date,'starttime' => $book->time_start,'endtime' => $book->time_end,'rate' => $book->rate, 'titleclient' => $titleclient, 'statusbookconfm' => $statusbookconfm, 'phone' => $phone],function ($message) use ($user) {
					$message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('Your Notifications'));
					$message->from('wdpnew@gmail.com','Wdp'); 
	        	});
	    		Mail::send('frontend.auth.emails.escortbookaccept',['nameuser' => $user->name,'date' => $book->book_date,'starttime' => $book->time_start,'endtime' => $book->time_end,'rate' => $book->rate, 'titlebookescort' => $titlebookescort],function ($message) use ($escort) {
				$message->to($escort->email, $escort->name)->subject(app_name() . ': ' . trans('Your Notifications'));
				$message->from('wdpnew@gmail.com','Wdp'); 
	    		});
				$str['action'].='<li class="approve_left">Accepted</li>';
				
			}
			elseif($book_arr->invitation_accepted=='R'){

				Mail::send('frontend.auth.emails.clientbookdecline',['nameescort' => $escort->name,'date' => $book->book_date,'starttime' => $book->time_start,'endtime' => $book->time_end,'rate' => $book->rate, 'title' => $title, 'status' => $status],function ($message) use ($user) {
					$message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('Your Notifications'));
					$message->from('wdpnew@gmail.com','Wdp'); 
	        	});
	    		Mail::send('frontend.auth.emails.escortbookdecline',['nameuser' => $user->name,'date' => $book->book_date,'starttime' => $book->time_start,'endtime' => $book->time_end,'rate' => $book->rate, 'titleescort' => $titleescort],function ($message) use ($escort) {
				$message->to($escort->email, $escort->name)->subject(app_name() . ': ' . trans('Your Notifications'));
				$message->from('wdpnew@gmail.com','Wdp'); 
	    		});

				$str['action'].='<li class="reject_right">Reject</li>';
			}
			else{
				$str['action'].='<li class="reject_right">Cancel</li>';
			}
			return $str;
			
		}
	}

	public function getBookingAutoCancel()
	{

			$current_date = date('Y-m-d H:i');
			$book = DB::table('bookings')->get();
			if(!empty($book))
			{
				foreach ($book as $key => $vals)
				{
					$book_date = date('Y-m-d', strtotime($vals->book_date)); 
					$book_time = date('H:i', strtotime($vals->time_end));
					$last_date = $book_date.' '.$book_time;
					$book_last_date = date('Y-m-d H:i', strtotime($last_date));
					//echo $current_date;
					//echo $book_last_date;
					if($current_date > $book_last_date)
					{
						//echo 'hii'; die;
						$user = DB::table('users')->where('id',$vals->user_id)->first();
						$escort = DB::table('users')->where('id',$vals->profile_id)->first();
						if(!empty($user) && !empty($escort))
						{
							$status = "Declined";
							$title = "Booking Declined";
							$titleescort = "Booking declined for @".$user->name;
							$value = array('invitation_accepted'=>'R');

							DB::table('bookings')->where('id',$vals->id)->update($value);
							Mail::send('frontend.auth.emails.clientbookdecline',['nameescort' => $escort->name,'date' => $vals->book_date,'starttime' => $vals->time_start,'endtime' => $vals->time_end,'rate' => $vals->rate, 'title' => $title, 'status' => $status],function ($message) use ($user) {
								$message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('Your Notifications'));
								$message->from('wdpnew@gmail.com','Wdp'); 
				        	});

				    		Mail::send('frontend.auth.emails.escortbookdecline',['nameuser' => $user->name,'date' => $vals->book_date,'starttime' => $vals->time_start,'endtime' => $vals->time_end,'rate' => $vals->rate, 'titleescort' => $titleescort],function ($message) use ($escort) {
							$message->to($escort->email, $escort->name)->subject(app_name() . ': ' . trans('Your Notifications'));
							$message->from('wdpnew@gmail.com','Wdp'); 
				    		});
				    	}
					}
				}
			}
	}

	public function getBookingEscort($username='')
	{
		$username=explode('-',$username);
        $id=$username[0];



        $date1 =  date('Y-m-d');
		$con = array('user_id' => $id, 'date' => $date1);
		$user_info1 = DB::table('user_prices')->select('rate_15m','rate_30m','rate_1h','rate_1d')->where($con)->first();
		if(!empty($user_info1))
		{
			$get_all_escort = $user_info1;
		}
		else
		{
			$con_arr=array('users.id'=>$id);
			$get_all_escort =DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->select('rate_15m','rate_30m','rate_1h','rate_1d')->where($con_arr)->first();		
		}



        /*$con_arr=array('users.user_type'=>'Escort','users.id'=>$id);
        $get_all_escort=DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where($con_arr)->first();*/
        $pricetolat =  8*$get_all_escort->rate_1h;
		$sel_date=date('m-d-Y');
		//echo $sel_date; die;

		$blockDate = array();
		$block_Date = DB::table('user_prices')->where('user_id',$id)->where('status', 'Block')->get();
			$blockDate= array();
		foreach ($block_Date as $key => $value) {
			$blockDate[] = date('m-d-Y', strtotime($value->date));
		}
		//dd($blockDate);



		return view('frontend.calendar.calenderviewescort', compact('sel_date','pricetolat','id','blockDate'));
		echo $username; die;
	}

	public function getPriceCalculate()
	{
		$date = explode('-', $_REQUEST['book_date']);
		//echo $_REQUEST['time_start']; die;
        $date1 =  $date[2].'-'.$date[0].'-'.$date[1];
		$con = array('user_id' => $_REQUEST['id'], 'date' => $date1);
		$user_info1 = DB::table('user_prices')->select('rate_15m','rate_30m','rate_1h','rate_1d')->where($con)->first();
		if(!empty($user_info1))
		{
			//echo "if";
			$get_all_escort = $user_info1;

		}
		else
		{
			//echo "else";
			$con_arr=array('users.id'=>$_REQUEST['id']);
			$get_all_escort =DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->select('rate_15m','rate_30m','rate_1h','rate_1d')->where($con_arr)->first();		
		}
		//echo "<pre>"; print_r($get_all_escort); die;
		//die;
		/*$con_arr=array('users.user_type'=>'Escort','users.id'=>$_REQUEST['id']);
        $get_all_escort=DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where($con_arr)->first();*/
        //echo "<pre>"; print_r($get_all_escort); die;
        $StartTime= $_REQUEST['time_start'];
        $EndTime = $_REQUEST['time_end'];
        if($StartTime == $EndTime)
        {
        	$pricetolat =0;
        	return $pricetolat; exit;
        }
        if($EndTime == '11:59 PM')
        {
        	$EndTime = '00:00 AM';
        }
        $sst = strtotime($StartTime);
        $eet=  strtotime($EndTime);
        $diff= $eet-$sst;
        $timeElapsed= gmdate("H:i",$diff);
        if($timeElapsed == '23:59')
        {
        	$pricetolat = $get_all_escort->rate_1d;
        	return $pricetolat;
        }
        if($timeElapsed == '00:00')
        {
        	$pricetolat = $get_all_escort->rate_1d;
        	return $pricetolat;
        }
        $explodeTime = explode(':', $timeElapsed);
        $priceH = $explodeTime[0]*$get_all_escort->rate_1h;
        $FindM = $explodeTime[1]%30;
        $find30M = ($explodeTime[1]-$FindM)/30;
        $price30M = $find30M*$get_all_escort->rate_30m;
        $find15M = $FindM/15;
        $price15M = $find15M*$get_all_escort->rate_15m;
        $pricetolat = $priceH+$price30M+$price15M;
        $pricetolat = number_format($pricetolat,2);
        return $pricetolat;
	}

	public function postEscortBooking()
	{
		session_start();
		unset($_SESSION['bookingArr']);
		$insert_arr = array('user_id' => $_REQUEST['user_id'], 'profile_id' => $_REQUEST['profile_id'], 'invitation_accepted' => 'P', 'book_date' => $_REQUEST['book_date'], 'time_start' => $_REQUEST['time_start'], 'time_end' => $_REQUEST['time_end'], 'is_active' => 'Y', 'rate' => $_REQUEST['rate']);
		$_SESSION['bookingArr'] = $insert_arr;
		return redirect()->to('checkout');
		//echo $bookingid; die;
	}

	public function getCheckout(){
		session_start();
		if(isset($_SESSION['bookingArr']))
		{
			$all_data = $_SESSION['bookingArr'];
			$con_arr=array('users.user_type'=>'Escort','users.id'=>$all_data['profile_id']);
			$get_all_escort = DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where($con_arr)->first();
			return view('frontend.booking.checkout',compact('get_all_escort','all_data'));
		}else{
			return redirect()->to('/');
		}
	}

	public function postCheckout()
	{
		session_start();
		$all_data = $_SESSION['bookingArr'];
		$date1 = explode('-', $all_data['book_date']);
        $date =  $date1[2].'-'.$date1[0].'-'.$date1[1];
		$user = DB::table('users')->where('id',$all_data['user_id'])->first();
		$escort = DB::table('users')->where('id',$all_data['profile_id'])->first();
		//echo '<pre>'; print_r($all_data); die;
		$title = "Booking successful waiting on confirmation" ;
		$titleescort = "Booking request" ;
		$status = "Waiting on confirmation for escort";
		$status1 = "Waiting on Your confirmation";

		$profile_arr = DB::table('users')->where('id', $all_data['profile_id'])->first();
		/*echo $profile_arr->id."-".$profile_arr->name;
		echo "<pre>"; print_r($profile_arr); die;*/


        	
		$insert_arr = array('user_id' => $all_data['user_id'], 'profile_id' => $all_data['profile_id'], 'invitation_accepted' => 'P', 'book_date' => $date, 'time_start' => $all_data['time_start'], 'time_end' => $all_data['time_end'], 'is_active' => 'Y', 'rate' => $all_data['rate']);
		DB::table('bookings')->insert($insert_arr);

		Mail::send('frontend.auth.emails.clientbook',['nameescort' => $escort->name,'date' => $all_data['book_date'],'starttime' => $all_data['time_start'],'endtime' => $all_data['time_end'],'rate' => $all_data['rate'], 'title' => $title, 'status' => $status],function ($message) use ($user) {
				$message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('Your Notifications'));
				$message->from('wdpnew@gmail.com','Wdp'); 
        	});
    	Mail::send('frontend.auth.emails.escortbook',['nameuser' => $user->name,'date' => $all_data['book_date'],'starttime' => $all_data['time_start'],'endtime' => $all_data['time_end'],'rate' => $all_data['rate'], 'titleescort' => $titleescort, 'status' => $status1],function ($message) use ($escort) {
			$message->to($escort->email, $escort->name)->subject(app_name() . ': ' . trans('Your Notifications'));
			$message->from('wdpnew@gmail.com','Wdp'); 
    	});
		unset($_SESSION['bookingArr']);
		return redirect()->to('/cast/'.$profile_arr->id."-".$profile_arr->name)->withFlashSuccess(trans("Booking successfully"));
	}

	public function getFeedback()
	{
		$sel_date=date('Y-m-d');
		$user_id=Auth::id();
		if(Auth::user()->user_type == 'Escort'){
			$cond=array('bookings.profile_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.user_id')->where($cond)->where('bookings.book_date', '<', $sel_date)->orderBy('bookings.book_date','DESC')->get();
		}
		else{
			$cond=array('bookings.user_id'=>$user_id);
			$booked_data_arr=DB::table('bookings')->select('bookings.*','users.id as uid','users.name','users.photo')->join('users', 'users.id', '=', 'bookings.profile_id')->where($cond)->where('bookings.book_date', '<', $sel_date)->orderBy('bookings.book_date','DESC')->get();
		}		
		return view('frontend.feedback',compact('booked_data_arr'));
	}
	public function getSaveFeedback()
	{
		//echo '<pre>'; print_r($_REQUEST); die;
		$id = $_REQUEST['id'];
		$from_id = $_REQUEST['from_id'];
		$to_id = $_REQUEST['to_id'];
		$type = $_REQUEST['type'];
		$review = $_REQUEST['review'];
		$accuract_rating = $_REQUEST['accuract_rating'];
		$communication_rating = $_REQUEST['communication_rating'];
		$hygiene_rating = $_REQUEST['hygiene_rating'];
		$friendliness_rating = $_REQUEST['friendliness_rating'];
		$cleanlines_rating = $_REQUEST['cleanlines_rating'];
		$talent_rating = $_REQUEST['talent_rating'];

		$rating = ($accuract_rating + $communication_rating + $hygiene_rating + $friendliness_rating + $cleanlines_rating + $talent_rating)/6;
		//$rating = $_REQUEST['rating'];
		$insert_arr = array('profile_id' => $to_id, 'user_id' => $from_id, 'description' => $review, 'accuract_rating' => $accuract_rating, 'communication_rating' => $communication_rating, 'hygiene_rating' => $hygiene_rating, 'friendliness_rating' => $friendliness_rating, 'cleanlines_rating' => $cleanlines_rating, 'talent_rating' => $talent_rating, 'rating' => $rating);

		$last_id = DB::table('reviews')->insertGetId($insert_arr);
		if($last_id) {
			$data = 'true';
			if($type == 'escort') {
				$update_arr = array('escort_feedback' => 'Yes');
			}
			else{
				$update_arr = array('user_feedback' => 'Yes');
			}
			DB::table('bookings')->where('id', $id)->update($update_arr);
			# Send Mail
			$from_user = DB::table('users')->where('id', $from_id)->first();
			$user = DB::table('users')->where('id', $to_id)->first();
			if($from_user->user_type == 'Escort'){
				$data = "My Angles Escort member ".$from_user->name;
			}
			else{
				$data = "My Angles User member '".$from_user->name."'";
			}
			Mail::send('frontend.auth.emails.feedback',['name' => $data, 'rating' => $rating, 'review' => $review],function ($message) use ($user) {
				$message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('Your Feedback'));
				$message->from('wdpnew@gmail.com','Wdp'); 
			});
			# Send Mail
		}
		else{
			$data = 'false';
		}
		return $data;
	}
}

?>
<?php
namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use DB,Auth,Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

/**
 * Class UserBookingController
 * @package App\Http\Controllers
 */
class UserBookingController extends Controller
{
	public function userBooking(){

		session_start();

		unset($_SESSION['insert_arr']);

		$input = Input::all();
		$e_name = $input['e_name'];
		$info = explode('-',$e_name);
		$escort_id = $info[0];
		
		// $date = $input['datetime'];
		// $date_arr = explode(' ', $date);

		// $date_m = date_parse($date_arr[1]);
		// $month = strlen($date_m['month']) > 1 ? $date_m['month'] : '0'.$date_m['month'];
		$booking_date = $input['datetime'];

		$booking_dates = DB::table('user_availability_dates')
					->where('user_id',$info[0])
					->where('date', $booking_date)	
					->where('is_active','Y')->get();

		$time_slot = array();
		if(count($booking_dates )>0){
			foreach ($booking_dates as $key => $value) {
				$time_slot[$key] = DB::table('available_time_slot_master')
							->where('id',$value->available_time_slot_id)
							->first();
			}
		}else{
				$time_slot = DB::table('available_time_slot_master')
							//->where('id',$value->available_time_slot_id)
							->get();
		}
		$disable_bookings = array();
		$other_bookings = DB::table('bookings')
						// ->whereRaw("user_id!='".Auth::id()."'")
						->where('book_date',$booking_date)
						->select('bookings.time_sloat_id')
						->get();
						foreach ($other_bookings as $key => $value) {
							$disable_bookings[$key] = $value->time_sloat_id;
						}

		// echo "<pre>"; print_r(count($time_slot));  print_r($time_slot); print_r($disable_bookings);   die;
		return view('frontend.user.time_slot_booking',compact('time_slot','booking_date','escort_id','disable_bookings'));
	}

	public function setBooking(){
		$input = Input::all();

		$booking_date = $input['booking_date'];
		$escort_id = $input['escort_id'];
		$time_slot = $input['time_slot'];
		$created_at = date('Y-m-d H:i:s');
		$insert_arr = array();
		// print_r(Auth::id());
		$insert_arr = array('user_id'=> Auth::id(), 'profile_id'=> $escort_id,'book_date'=>$booking_date, 'time_sloat_id'=>$time_slot, 'is_active'=>'Y', 'created_at' => $created_at);
		session_start();

		$_SESSION['insert_arr'] = $insert_arr;

        DB::table('bookings')->insert($insert_arr);
        return redirect()->to('user/booking/checkout');
		
	}

	public function checkout(){
		session_start();
		$all_data = array();
		if(isset($_SESSION['insert_arr'])){

		
			$all_data = $_SESSION['insert_arr'];
			

			$con_arr=array('users.user_type'=>'Escort','users.id'=>$all_data['profile_id']);
			$get_all_escort = DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where($con_arr)->first();

			$time_slot = DB::table('available_time_slot_master')
								->where('id',$all_data['time_sloat_id'])
								->first();


			$cart['time_sloat_id'] = $all_data['time_sloat_id'];
			$cart['profile_id'] = $all_data['profile_id'];
			$cart['book_date'] = $all_data['book_date'];

			// $user_images = DB::table('user_images')->where('user_id', $all_data['profile_id']);
			return view('frontend.user.checkout',compact('get_all_escort','time_slot','cart'));
		}else{
			return redirect()->to('/');
		}

	}
	public function postCheckout()
	{
		return redirect()->to('/myprofile')->withFlashSuccess(trans("Booking successfully"));
	}
}
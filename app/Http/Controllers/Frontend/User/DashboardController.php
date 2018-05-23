<?php namespace App\Http\Controllers\Frontend\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB,Auth;
use Illuminate\Support\Facades\Input;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Frontend
 */
class DashboardController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	*/
	public function index()
	{
		session_start(); 
		//echo "<pre>"; print_r($_SESSION); die;
		//session_destroy();
		if(isset(Auth::user()->id))
		{
          $logged_user=Auth::user();
		  $_SESSION['userid'] = $logged_user->id; 

		}else{
			$logged_user=0;
			$_SESSION['userid']=0;
		}

		session_unset('image');
		$country=$this->getcountry();
        $age=$this->getAge();
		//echo "<pre>"; print_r($country);
		//echo "<pre>"; print_r($age);die;
		$service_arr = DB::table('services')->where('is_active', 'Y')->get();
		$cantons = DB::table('cantons')->where('is_active', 'Yes')->get();
		//echo '<pre>'; print_r($canton); die;
		$language_arr = DB::table('languages')->where('is_active', 'Y')->get();
		$user_Service_arr=DB::table('user_services')->join('services' , 'services.id','=', 'user_services.service_id')->where('services.is_active', 'Y')->where('user_id',access()->user()->id)->get();
		//echo "<pre>"; print_r($user_Service_arr);die;
		$user_Service_id=DB::table('user_services')->where('user_id',access()->user()->id)->get();
		$user_images_arr_yes=DB::table('user_images')->where('user_id',access()->user()->id)->where('slider_image', 'Yes')->first();
		$user_images_arr_no=DB::table('user_images')->where('user_id',access()->user()->id)->first();
		$user_images_arr=DB::table('user_images')->where('user_id',access()->user()->id)->orderBy('created_at','DESC')->get();
		$user_language_id=DB::table('user_languages')->where('user_id',access()->user()->id)->get();
		$user_Language_arr=DB::table('user_languages')->join('languages' , 'languages.id','=', 'user_languages.language_id')->where('languages.is_active', 'Y')->where('user_id',access()->user()->id)->get();
		$user_info_arr=DB::table('user_informations')->where('user_id',access()->user()->id)->first();
		//echo '<pre>'; print_r($user_info_arr); die;
		$review_arr = DB::table('reviews')->join('users', 'reviews.user_id', '=', 'users.id')->select('reviews.*','users.name', 'users.photo')->where('reviews.profile_id', access()->user()->id)->orderBy('reviews.created_at', 'DESC')->get();
		$user_rating_sum = DB::table('reviews')->selectRaw('sum(rating) as sum')->where('reviews.profile_id', access()->user()->id)->first();
		if(!empty($user_info_arr)){
			$canton = DB::table('cantons')->where('name', $user_info_arr->canton)->first();
		}
		$region_arr='';
		if(!empty($canton))
		{			
		$region_arr = DB::table('regions')->where('canton_id', $canton->id)->get();
		}
		// echo "<pre>";print_r(access()->user()->id); print_r($user_images_arr_no); 
		if(empty($user_info_arr))
		{
			$insert_arr = array('user_id' => access()->user()->id);
			DB::table('user_informations')->insert($insert_arr);
			$user_info_arr=DB::table('user_informations')->where('user_id',access()->user()->id)->first();
		}
		//print_r($user_info_arr); die;
		$id = access()->user()->id;
		
		$user_review_arr = DB::table('reviews')->join('users', 'reviews.user_id', '=', 'users.id')->select('reviews.*','users.name', 'users.photo')->where('reviews.profile_id', $id)->orderBy('reviews.created_at', 'DESC')->get();
		 $user_rating_accuract_sum = DB::table('reviews')->selectRaw('sum(accuract_rating) as sum')->where('reviews.profile_id', $id)->first();

        $user_rating_communication_sum = DB::table('reviews')->selectRaw('sum(communication_rating) as sum')->where('reviews.profile_id', $id)->first();

        $user_rating_hygiene_sum = DB::table('reviews')->selectRaw('sum(hygiene_rating) as sum')->where('reviews.profile_id', $id)->first();
        $user_rating_friendliness_sum = DB::table('reviews')->selectRaw('sum(friendliness_rating) as sum')->where('reviews.profile_id', $id)->first();
        $user_rating_cleanlines_sum = DB::table('reviews')->selectRaw('sum(cleanlines_rating) as sum')->where('reviews.profile_id', $id)->first();
        $user_rating_talent_sum = DB::table('reviews')->selectRaw('sum(talent_rating) as sum')->where('reviews.profile_id', $id)->first();
		
		return view('frontend.user.dashboard',compact('user_info_arr','user_Service_arr','user_Language_arr','service_arr','user_Service_id', 'language_arr', 'user_language_id', 'review_arr', 'user_rating_sum', 'user_images_arr', 'age', 'country', 'region_arr', 'user_images_arr_yes', 'user_images_arr_no', 'cantons', 'user_rating_accuract_sum', 'user_rating_communication_sum', 'user_rating_hygiene_sum', 'user_rating_friendliness_sum', 'user_rating_cleanlines_sum', 'user_rating_talent_sum', 'user_review_arr'))->withUser(access()->user());
	}
	
	# Ajex Function Management Start
	public function getUserProfileEdit()
	{
		$name = $_REQUEST['name'];
		//$phone = $_REQUEST['phone'];
		$user_id = Auth::User()->id;
		$con = array('name' => $name/*,'phone' => $phone*/);
		DB::table('users')->where('id', $user_id)->update($con);
		return $user_id;
	}
	public function getUserProfileDetails()
	{
		//echo '<pre>'; print_r($_REQUEST); die;
		$phone = $_REQUEST['phone'];
		/*$instruction = $_REQUEST['instruction'];
		$minimum_rate = $_REQUEST['minimum_rate'];
		$region = $_REQUEST['region'];
		$age = $_REQUEST['age'];
		$nationality = $_REQUEST['nationality'];
		$rate_15m = $_REQUEST['rate_15m'];
		$rate_30m = $_REQUEST['rate_30m'];
		$rate_1h = $_REQUEST['rate_1h'];
		$rate_1d = $_REQUEST['rate_1d'];*/
		$user_id = Auth::User()->id;
		$con = array('phone' => $phone);
		DB::table('users')->where('id', $user_id)->update($con);
		//$con_user = array('instruction' => $instruction, 'minimum_rate' => $minimum_rate, 'region' =>$region, 'age' => $age, 'nationality' => $nationality, 'rate_15m' => $rate_15m, 'rate_30m' => $rate_30m, 'rate_1h' => $rate_1h, 'rate_1d' => $rate_1d);
		//DB::table('user_informations')->where('user_id', $user_id)->update($con_user);
		//return $user_id;
		
		$instruction = $_REQUEST['instruction'];
		$age = $_REQUEST['age'];
		$nationality = $_REQUEST['nationality'];
		$canton = $_REQUEST['canton'];
		$weight = $_REQUEST['weight'];
		$height = $_REQUEST['height'];
		$city = $_REQUEST['city'];
		$ethnicity = $_REQUEST['ethnicity'];
		$eyes = $_REQUEST['eyes'];
		$hair = $_REQUEST['hair'];
		$breast_size = $_REQUEST['breast_size'];
		$location = $_REQUEST['location'];
		$pubic_hair = $_REQUEST['pubic_hair'];
		$orientation = $_REQUEST['orientation'];
		$rate_15m = $_REQUEST['rate_15m'];
		$rate_30m = $_REQUEST['rate_30m'];
		$rate_1h = $_REQUEST['rate_1h'];
		$rate_1d = $_REQUEST['rate_1d'];
		$user_id = Auth::User()->id;
		$con_user = array('instruction' => $instruction, 'age' => $age, 'nationality' =>$nationality, 'canton' => $canton, 'weight' => $weight, 'height' => $height, 'city' => $city, 'ethnicity' => $ethnicity, 'eyes' => $eyes, 'hair' => $hair, 'breast_size' => $breast_size, 'location' => $location, 'pubic_hair' => $pubic_hair, 'orientation' => $orientation, 'rate_15m' => $rate_15m, 'rate_30m' => $rate_30m, 'rate_1h' => $rate_1h, 'rate_1d' => $rate_1d);
		DB::table('user_informations')->where('user_id', $user_id)->update($con_user);

		$rating = $_REQUEST['rating'];
		$language_id = $_REQUEST['language_id'];
		DB::table('user_languages')->where('user_id',$user_id)->delete();
		if(!empty($language_id)){
			foreach($language_id as $key=>$value){
				$con_user = array('user_id' => $user_id, 'language_id' => $value, 'rating' => $rating[$key]);
				DB::table('user_languages')->insert($con_user);
			}
		}

		return $user_id;

	}

	public function getUserProfiledetailsclient()
	{
		//echo '<pre>'; print_r($_REQUEST); die;
		$phone = $_REQUEST['phone'];
		/*$instruction = $_REQUEST['instruction'];
		$minimum_rate = $_REQUEST['minimum_rate'];
		$region = $_REQUEST['region'];
		$age = $_REQUEST['age'];
		$nationality = $_REQUEST['nationality'];
		$rate_15m = $_REQUEST['rate_15m'];
		$rate_30m = $_REQUEST['rate_30m'];
		$rate_1h = $_REQUEST['rate_1h'];
		$rate_1d = $_REQUEST['rate_1d'];*/
		$user_id = Auth::User()->id;
		$con = array('phone' => $phone);
		DB::table('users')->where('id', $user_id)->update($con);
		//$con_user = array('instruction' => $instruction, 'minimum_rate' => $minimum_rate, 'region' =>$region, 'age' => $age, 'nationality' => $nationality, 'rate_15m' => $rate_15m, 'rate_30m' => $rate_30m, 'rate_1h' => $rate_1h, 'rate_1d' => $rate_1d);
		//DB::table('user_informations')->where('user_id', $user_id)->update($con_user);
		//return $user_id;

		$canton = $_REQUEST['canton'];
		$city = $_REQUEST['city'];
		$nationality = $_REQUEST['nationality'];
		$ethnicity = $_REQUEST['ethnicity'];
		$age = $_REQUEST['age'];
		$location = $_REQUEST['location'];
		$orientation = $_REQUEST['orientation'];
		$instruction = $_REQUEST['instruction'];

		$user_id = Auth::User()->id;
		$con_user = array('canton' => $canton, 'city' => $city, 'nationality' =>$nationality, 'ethnicity' => $ethnicity, 'age' => $age, 'location' => $location, 'orientation' => $orientation, 'instruction' => $instruction);
		DB::table('user_informations')->where('user_id', $user_id)->update($con_user);

		$rating = $_REQUEST['rating'];
		$language_id = $_REQUEST['language_id'];
		DB::table('user_languages')->where('user_id',$user_id)->delete();
		if(!empty($language_id)){
			foreach($language_id as $key=>$value){
				$con_user = array('user_id' => $user_id, 'language_id' => $value, 'rating' => $rating[$key]);
				DB::table('user_languages')->insert($con_user);
			}
		}

		return $user_id;

	}

	/*public function getUserProfileRates()
	{
		//echo '<pre>'; print_r($_REQUEST); die;
		$rate_15m = $_REQUEST['rate_15m'];
		$rate_30m = $_REQUEST['rate_30m'];
		$rate_1h = $_REQUEST['rate_1h'];
		$rate_1d = $_REQUEST['rate_1d'];
		$user_id = Auth::User()->id;
		$con_user = array('rate_15m' => $rate_15m, 'rate_30m' => $rate_30m, 'rate_1h' => $rate_1h, 'rate_1d' => $rate_1d);
		DB::table('user_informations')->where('user_id', $user_id)->update($con_user);
		return $user_id;
	}*/

	public function getUserProfileServices()
	{
		$service_id = $_REQUEST['service_id'];
		$user_id = Auth::User()->id;
		DB::table('user_services')->where('user_id',$user_id)->delete();
		if(!empty($service_id)){
			foreach($service_id as $value){
				$con_user = array('user_id' => $user_id, 'service_id' => $value);
				DB::table('user_services')->insert($con_user);
			}
		}
		return $user_id;
	}
	/*public function getUserProfileLanguages()
	{
		$rating = $_REQUEST['rating'];
		$language_id = $_REQUEST['language_id'];
		$user_id = Auth::User()->id;
		DB::table('user_languages')->where('user_id',$user_id)->delete();
		if(!empty($language_id)){
			foreach($language_id as $key=>$value){
				$con_user = array('user_id' => $user_id, 'language_id' => $value, 'rating' => $rating[$key]);
				DB::table('user_languages')->insert($con_user);
			}
		}
		return $user_id;
	}*/
	public function getUserProfileEditMessage()
	{
		$message = $_REQUEST['message'];
		$user_id = Auth::User()->id;
		$con_user = array('message' => $message);
		DB::table('user_informations')->where('user_id', $user_id)->update($con_user);
		return $user_id;
	}
	public function getUserProfileEditImages()
	{
		$user_id = $_REQUEST['user_id'];
		session_start();
		$files = $_SESSION['image'];
		if(!empty($files)){
			foreach($files as $key=>$value){
				DB::table('user_images')->insert(['user_id' => $user_id, 'filename' => $value]);
			}
			session_destroy();
		}
		$user_images_arr=DB::table('user_images')->where('user_id',access()->user()->id)->orderBy('created_at','DESC')->get();
		$data='';
		$data.="<ul id='content-3'>";
		foreach($user_images_arr as $value){
			$data.= "<li>
				<div class='hovereffect'>
					<img src='".url('/')."/img/users/".$value->filename."'>
					<div class='overlay'>
						<a class='info' href='#'><i class='fa fa-search' aria-hidden='true'></i></a>
					</div>
				</div>
				<span class='close_image'><i class='fa fa-times' aria-hidden='true'></i></span>
			</li>";
		}
		$data.="</ul>";
		echo $data;
	}
	public function getUserProfileImagesRemove()
	{
		$id = $_REQUEST['id'];
		DB::table('user_images')->where('id', $id)->delete();
		$user_images_arr=DB::table('user_images')->where('user_id',access()->user()->id)->orderBy('created_at','DESC')->get();
		$data="<ul id='content-3'>";
		foreach($user_images_arr as $value){
			$data.= "<li>
				<div class='hovereffect'>
					<img src='".url('/')."/img/users/".$value->filename."'>
					<div class='overlay'>
						<a class='info' href='#'><i class='fa fa-search' aria-hidden='true'></i></a>
					</div>
				</div>
				<span class='close_image' onclick='img_remove(".$value->id.")' style='display: block;'><i class='fa fa-times' aria-hidden='true'></i></span> 
			</li>";
		}
		$data.="</ul>";
		echo $data;
	}
	public function getUserProfileEditImage()
	{
		$user_id = Auth::User()->id;
		//echo $user_id; exit;
		session_start(); 
		$files = $_SESSION['image'];
		if(!empty($files)){
			foreach($files as $key=>$value){
				DB::table('users')->where('id', $user_id)->update(['photo' => $value]);
			}
			session_destroy();
		}
		$user_images_arr=DB::table('users')->where('id',access()->user()->id)->first();
		$data = "<img class='img-responsive' src='".url('/')."/img/users/".$user_images_arr->photo."'>";
		echo $data;
	}


	public function getUserProfileEditCoverImage()
	{
		$user_id = Auth::User()->id;
		session_start(); 
		$files = $_SESSION['image'];
		if(!empty($files)){
			foreach($files as $key=>$value){
				DB::table('users')->where('id', $user_id)->update(['coverphoto' => $value]);
			}
			session_destroy();
		}
		$user_images_arr=DB::table('users')->where('id',access()->user()->id)->first();
		//$data = "<img class='img-responsive' src='".url('/')."/img/users/".$user_images_arr->photo."'>";
		$data = "<img src='".url('timthumb.php')."?src=".url('img/users')."/".$user_images_arr->coverphoto."&q=530&w=1349' alt='Owl Image'>";
		echo $data;
	}



	public function getUserProfileSliderImg()
	{
		$id = $_REQUEST['id'];
		$user_id = Auth::User()->id;
		$con = array('slider_image' => 'No');
		DB::table('user_images')->where('user_id', $user_id)->update($con);
		$con1 = array('slider_image' => 'Yes');
		DB::table('user_images')->where('id', $id)->update($con1);

	}
	# Ajex Function Management End
}
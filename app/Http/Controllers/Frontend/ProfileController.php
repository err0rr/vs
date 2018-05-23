<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Input;   

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function getProfile($username=NULL)
    {
        $username=explode('-',$username);
        $id=$username[0];
        //$con_arr=array('users.user_type'=>'Escort','users.id'=>$id);
        $con_arr=array('users.id'=>$id);
        $get_all_escort=DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where($con_arr)->first();
        $user_Service_arr=DB::table('user_services')->join('services' , 'services.id','=', 'user_services.service_id')->where('services.is_active', 'Y')->where('user_id',$id)->get();
        $user_Language_arr=DB::table('user_languages')->join('languages' , 'languages.id','=', 'user_languages.language_id')->where('languages.is_active', 'Y')->where('user_id',$id)->get();
		$user_review_arr = DB::table('reviews')->join('users', 'reviews.user_id', '=', 'users.id')->select('reviews.*','users.name', 'users.photo')->where('reviews.profile_id', $id)->orderBy('reviews.created_at', 'DESC')->get();
		$user_rating_sum = DB::table('reviews')->selectRaw('sum(rating) as sum')->where('reviews.profile_id', $id)->first();
		$user_images_arr_yes=DB::table('user_images')->where('user_id',$id)->where('slider_image', 'Yes')->first();
		$user_images_arr_no=DB::table('user_images')->where('user_id',$id)->first();
		$user_images_arr=DB::table('user_images')->where('user_id',$id)->orderBy('created_at','DESC')->get();

        $user_rating_accuract_sum = DB::table('reviews')->selectRaw('sum(accuract_rating) as sum')->where('reviews.profile_id', $id)->first();

        $user_rating_communication_sum = DB::table('reviews')->selectRaw('sum(communication_rating) as sum')->where('reviews.profile_id', $id)->first();

        $user_rating_hygiene_sum = DB::table('reviews')->selectRaw('sum(hygiene_rating) as sum')->where('reviews.profile_id', $id)->first();
        $user_rating_friendliness_sum = DB::table('reviews')->selectRaw('sum(friendliness_rating) as sum')->where('reviews.profile_id', $id)->first();
        $user_rating_cleanlines_sum = DB::table('reviews')->selectRaw('sum(cleanlines_rating) as sum')->where('reviews.profile_id', $id)->first();
        $user_rating_talent_sum = DB::table('reviews')->selectRaw('sum(talent_rating) as sum')->where('reviews.profile_id', $id)->first();
        //echo count($user_review_arr);
        //echo $user_rating_communication_sum->sum; die;


        return view('frontend.profile.detail',compact('get_all_escort','user_Service_arr','user_Language_arr', 'user_review_arr', 'user_rating_sum', 'user_images_arr', 'user_images_arr_yes', 'user_images_arr_no', 'user_rating_accuract_sum', 'user_rating_communication_sum', 'user_rating_hygiene_sum', 'user_rating_friendliness_sum', 'user_rating_cleanlines_sum', 'user_rating_talent_sum'));
    }
}

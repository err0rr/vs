<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use DB,Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Auth;
/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    // start custom wdp
    public function getsetchatsession()
    {
        if( !Auth::guest() )
        {
            $logged_user=Auth::user();
            session_start();
            /* In your own login.php */
            /* After you authenticate the user */
            $_SESSION['userid'] = $logged_user->id; // Modify to suit requirements 
        }
        echo "yes";exit;
    }
    // end custom wdp
    public function index()
    {		
        $canton = DB::table('cantons')->orderBy('name', 'ASC')->where('is_active', 'Yes')->get();
        
        $country=$this->getcountry();
        $age=$this->getAge();
       /* $get_all_escort=DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where('users.user_type','Escort')->where('status', 1)->skip(0)->take(9)->get();*/
        $get_all_escort=DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where('users.user_type','Escort')->where('status', 1)->get();
        $get_all_escortcount=DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where('users.user_type','Escort')->where('status', 1)->get();
        $total=count($get_all_escortcount);
		/*foreach($get_all_escort as  $key=>$value)
		{
			$get_all_escort[$key]['user']=$value;
			$get_all_escort[$key]['rat']=DB::table('reviews')->selectRaw('sum(rating) as sum')->where('reviews.profile_id', 16)->first();
		}*/
        //echo "<pre>";print_r($get_all_escort); die;
        $data = $this->getBookingReject();
        return view('frontend.index',compact('country','age','get_all_escort','total','canton'));
    }
    public function escortRating($id=NULL)
    {
        $user_review_arr = DB::table('reviews')->join('users', 'reviews.user_id', '=', 'users.id')->select('reviews.*','users.name', 'users.photo')->where('reviews.profile_id', $id)->orderBy('reviews.created_at', 'DESC')->get();
        $user_rating_sum = DB::table('reviews')->selectRaw('sum(rating) as sum')->where('reviews.profile_id', $id)->first();
        return compact('user_review_arr', 'user_rating_sum');
    }
    public function listFilter()
    { //echo 'hii'; die;
        $canton1 = DB::table('cantons')->get();
        $country=$this->getcountry();
        $age=$this->getAge();
        $input=$_REQUEST;
        // $name=$input['name'];
        $canton=$input['canton'];     
        $region=$input['region'];
        $ages=$input['age'];
        $sexuality=$input['sexuality'];
        $requestdata=array('canton'=>$canton,'region'=>$region,'age'=>$ages,'sexuality'=>$sexuality);
        Session::forget('serachdata');
        Session::push('serachdata', $requestdata);
       
        $query= DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where('users.user_type','Escort');
                if(isset($canton) && $canton!="" && $canton!='0')
                    {
                        $query->where("user_informations.canton" ,$canton);
                    }
                    if(isset($region) && $region!="" && $region!='0')
                    {
                        $query->where("user_informations.region" ,$region);
                    }
                    if(isset($ages) && $ages!="" && $ages!=0)
                    {
                        $query->where("user_informations.age", '<=',$ages);
                    }
                    if(isset($sexuality) && $sexuality!="" && $sexuality!='0')
                    {
                        $query->where("user_informations.sexuality" ,$sexuality);
                    }
        $get_all_escortcount=$query->get();
        $get_all_escort=$query->where('status', 1)->skip(0)->take(9)->get();
        $total=count($get_all_escortcount);
        return view('frontend.searchdata',compact('get_all_escort','country','age','total','canton1'));
        
    }
     public function getfilterdata1()
    { //echo 'hii'; die;
        $canton1 = DB::table('cantons')->get();
        $country=$this->getcountry();
        $age=$this->getAge();
        $input=$_REQUEST;
        // $name=$input['name'];
        $canton=$input['canton'];     
        $region=$input['region'];
        $ages=$input['age'];
        $sexuality=$input['sexuality'];

      // echo '<pre>'; print_r($_REQUEST);
      // echo '<pre>'; print_r($canton);
      // echo '<pre>'; print_r($region);
      // echo '<pre>'; print_r($ages);
       // echo '<pre>'; print_r($sexuality); die;
        $requestdata=array('canton'=>$canton,'region'=>$region,'age'=>$ages,'sexuality'=>$sexuality);
        Session::forget('serachdata');
        Session::push('serachdata', $requestdata);
       
        $query= DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where('users.user_type','Escort');
                if(isset($canton) && $canton!="" && $canton!='0')
                    {
                        $query->where("user_informations.canton" ,$canton);
                    }
                    if(isset($region) && $region!="" && $region!='0')
                    {
                        $query->where("user_informations.region" ,$region);
                    }
                    if(isset($ages) && $ages!="" && $ages!=0)
                    {
                        $query->where("user_informations.age", '<=',$ages);
                    }
                    if(isset($sexuality) && $sexuality!="" && $sexuality!='0')
                    {
                        $query->where("user_informations.sexuality" ,$sexuality);
                    }
        $get_all_escortcount=$query->get();
        $get_all_escort=$query->where('status', 1)->get();
        $total=count($get_all_escortcount);
        return view('frontend.getfilterdata',compact('get_all_escort','country','age','total','canton1'));
        
    }
    public function getfilterdata(){

        $serachdata= Session::get('serachdata');
        $skipreco = $_REQUEST['group_no'];
         $position = ($skipreco * 9);
        $query=DB::table('users')->join('user_informations','users.id','=','user_informations.user_id')->where('users.user_type','Escort');
            if(isset($serachdata) && count($serachdata)>0)
            {                
                $serachdata= Session::get('serachdata');
                //Session::forget('serachdata');
               // echo "<pre>"; print_r($serachdata);
                
                 if(isset($serachdata[0]['canton']) && $serachdata[0]['canton']!="" && $serachdata[0]['canton']!="0")
                    {
                       // echo "if1"; 
                        $canton=$serachdata[0]['canton'];
                         $query->where("user_informations.canton" ,$canton);
                    }
                    if(isset($serachdata[0]['region']) && $serachdata[0]['region']!="" && $serachdata[0]['region']!="0")
                    {
                        //echo "if12"; 
                        $region=$serachdata[0]['region'];
                        $query->where("user_informations.region" ,$region);
                    }
                    if(isset($serachdata[0]['age']) && $serachdata[0]['age']!="" && $serachdata[0]['age']!=0)
                    {
                        //echo "if13"; 
                        $ages=$serachdata[0]['age'];
                        $query->where("user_informations.age", '<=',$ages);
                    }
                    if(isset($serachdata[0]['sexuality']) && $serachdata[0]['sexuality']!="" && $serachdata[0]['sexuality']!="0")
                    {
                       // echo "if14";
                        $sexuality=$serachdata[0]['sexuality'];
                        $query->where("user_informations.sexuality" ,$sexuality);
                    }
            }
       $get_all_escort= $query->skip($position)->take(9)->get();
      // echo "<pre>"; print_r($get_all_escort); die;
        echo view('frontend.getfilterdata', compact('get_all_escort'));
        exit;

    }
/*    public function getCanton()
    {
        $canton = $_REQUEST['name'];
        //echo '<pre>'; print_r($canton); die;
        $region = $_REQUEST['region'];
        $canton = DB::table('cantons')->where('name', $canton)->first();
        $region_arr='';
        if(!empty($canton))
        {           
            $region_arr = DB::table('regions')->where('canton_id', $canton->id)->get();
        }
        $data='';
        $data.="<option value='0'>All Region</option>";
        foreach ($region_arr as $key => $value) {
            $data.="<option ";
            if($region == $value->name)
            {
                $data.="selected=selected";
            }
            $data.=" value=".$value->name.">".$value->name."</option>";
           
        }
        echo $data; 
    }*/

    public function getCanton()
    {
        $canton = $_REQUEST['name'];
        $canton = DB::table('cantons')->where('name', $canton)->first();
        $region_arr='';
        $data='';
        $data.="<select class='form-control select_box target' name='region' id='region'>";
        $data.="<option value='0'>All Region</option>";
        if(!empty($canton))
        {           
            $region_arr = DB::table('regions')->where('canton_id', $canton->id)->get();
            if(count($region_arr) > 0){
                foreach ($region_arr as $key => $value) {
                    $data.="<option ";
                    $data.=" value=".$value->name.">".$value->name."</option>";
                }
            }
        }
        $data.="</select>";
        return json_encode($data); 
    }

    /**
     * @return \Illuminate\View\View
     */
    public function signup()
    {
        return view('frontend.signup');
    }
    public function escortregister()
    {
        //$canton=$this->getcanton();
        $canton = DB::table('cantons')->get();
        return view('frontend.auth.e-register',compact('canton'));
    }
    public function postEscortregister()
    {
        print_r($_REQUEST);exit;
        return view('frontend.auth.e-register');
    }
    public function addgallery()
    {        
        return view('frontend.user.addgallery');
    }
    
	
	public function faq()
    {
		$faq_arr = DB::table('faqs')->where('is_active', 'Y')->orderBy('updated_at', 'DESC')->get();
		//echo "<pre>"; print_r($faq_arr); die;
        return view('frontend.faq', compact('faq_arr'));
	}	

    public function contactUs()
    {

        return view('frontend/contact_us');
    }   

    public function postContactUs()
    {
        $input = Input::all();
        $value = array('name' => $input['name'], 'email' => $input['email'], 'phone' => $input['phone'], 'subject' => $input['subject'], 'message' => $input['message'], 'created_at' => date('Y-m-d h:i:s'));
        DB::table('contactus')->insert($value);
        return redirect()->to('/')->withFlashSuccess('Successfully send Your Contact information.');
    }

    public function getBookingReject()
    {
        $current_date = date('Y-m-d');
        $booking_arra = DB::table('bookings')->where('invitation_accepted','P')->where('book_date','<',$current_date)->get();
        if(!empty($booking_arra))
        {
            foreach ($booking_arra as $key => $value) 
            {
                $booking_id = $value->id;
                $up_arr=array('invitation_accepted'=>'R');
                DB::table('bookings')->where('id',$booking_id)->update($up_arr);
                $book_arr=DB::table('bookings')->where('id',$booking_id)->first();
                $str=array();
                $str['time_sloat_id'] = $book_arr->time_sloat_id;
                $str['action'] = '';
                $book = DB::table('bookings')->where('id', $booking_id)->first();
                $user = DB::table('users')->where('id',$book->user_id)->first();
                $escort = DB::table('users')->where('id',$book->profile_id)->first();
                $status = "Declined";
                $title = "Booking Declined";
                $titleescort = "Booking declined for @".$user->name;
                Mail::send('frontend.auth.emails.clientbookdecline',['nameescort' => $escort->name,'date' => $book->book_date,'starttime' => $book->time_start,'endtime' => $book->time_end,'rate' => $book->rate, 'title' => $title, 'status' => $status],function ($message) use ($user) {
                    $message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('Your Notifications'));
                    $message->from('wdpnew@gmail.com','Wdp'); 
                });
                Mail::send('frontend.auth.emails.escortbookdecline',['nameuser' => $user->name,'date' => $book->book_date,'starttime' => $book->time_start,'endtime' => $book->time_end,'rate' => $book->rate, 'titleescort' => $titleescort],function ($message) use ($escort) {
                $message->to($escort->email, $escort->name)->subject(app_name() . ': ' . trans('Your Notifications'));
                $message->from('wdpnew@gmail.com','Wdp'); 
                });              
            }
        }
        $data = "true";
        return $data;
    }
}

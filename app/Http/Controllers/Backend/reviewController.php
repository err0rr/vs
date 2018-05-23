<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB,Auth;
use Session;
use Validator;
use Redirect;
/**
 * Class FaqsController
 * @package App\Http\Controllers\Backend
 */
class reviewController  extends Controller
{
   public function review()
   {
        $reviews = DB::table('reviews')
        ->leftjoin('users','users.id', '=' ,'reviews.profile_id')
        ->select('users.*','reviews.*')
        ->groupBy('reviews.profile_id')
        ->get();            
          //echo '<pre>'; print_r($reviews); die;
    	return view('backend.review.review',compact('reviews'));
   }  
   public function reviewView($id=null)
   {
   	     $reviews = DB::table('reviews')
        ->join('users','users.id', '=' ,'reviews.user_id')
        ->select('users.name','reviews.*') 
        ->where('profile_id',$id)      
        ->get();  
         //echo '<pre>'; print_r($reviews); die;       
          //$review_view=DB::table('reviews')->where('profile_id',$id)->get();        
    	 return view('backend.review.viewreview', compact('reviews'));
   }

   public function getReviewEditForm(){
       $data = DB::table('reviews')->where('id',$_REQUEST['id'])->first();
       return json_encode($data);        
    }

    public function postReviewSave(){
              
            $description = $_REQUEST['description'];
            $values = array('description'=>$description, 'updated_at' => date('Y-m-d H:i:s'));
            $task = DB::table('reviews')->where('id',$_REQUEST['id'])->update($values);
            $reviews_arr = DB::table('reviews')->where('id',$_REQUEST['id'])->first();
            $reviews = DB::table('reviews')
              ->join('users','users.id', '=' ,'reviews.user_id')
              ->select('users.name','reviews.*') 
              ->where('profile_id',$reviews_arr->profile_id)      
              ->get();
            $url=URL('/');
            $task1 = '';
            foreach ($reviews as $key => $vals) {
               // echo $vals->is_active; die;
                $ids = $key+1;

                $task1.='<tr><td>'.$ids.'</td><td>'.ucfirst($vals->name).'</td><td>'.ucfirst($vals->rating).'</td><td>'.$vals->description.'</td><td>'.ucfirst($vals->created_at).'</td><td><button class="btn btn-warning btn-xs btn-detail open-modal" id="idsav" value="'.$vals->id.'">Edit</button></td></tr>';    

            }
            //$task1 = "true";     
            return json_encode($task1);
             
    } 
  public function getSaveFeedback()
  {
      $id = $_REQUEST['id'];
      $from_id = $_REQUEST['from_id'];
      $to_id = $_REQUEST['to_id'];
      $type = $_REQUEST['type'];
      $description = $_REQUEST['description'];
      $accuract_rating = $_REQUEST['accuract_rating'];
      $communication_rating = $_REQUEST['communication_rating'];
      $hygiene_rating = $_REQUEST['hygiene_rating'];
      $friendliness_rating = $_REQUEST['friendliness_rating'];
      $cleanlines_rating = $_REQUEST['cleanlines_rating'];
      $talent_rating = $_REQUEST['talent_rating'];
      $rating = ($accuract_rating + $communication_rating + $hygiene_rating + $friendliness_rating + $cleanlines_rating + $talent_rating)/6;
      $values = array('profile_id' => $to_id, 'user_id' => $from_id, 'description' => $description, 'accuract_rating' => $accuract_rating, 'communication_rating' => $communication_rating, 'hygiene_rating' => $hygiene_rating, 'friendliness_rating' => $friendliness_rating, 'cleanlines_rating' => $cleanlines_rating, 'talent_rating' => $talent_rating, 'rating' => $rating);
      $task = DB::table('reviews')->where('id',$_REQUEST['id'])->update($values);
      $reviews_arr = DB::table('reviews')->where('id',$_REQUEST['id'])->first();
      $reviews = DB::table('reviews')
        ->join('users','users.id', '=' ,'reviews.user_id')
        ->select('users.name','reviews.*') 
        ->where('profile_id',$reviews_arr->profile_id)      
        ->get();
      $url=URL('/');
      $task1 = '';
      foreach ($reviews as $key => $vals) {
          $ids = $key+1;

          $task1.='<tr><td>'.$ids.'</td><td>'.ucfirst($vals->name).'</td><td>'.ucfirst($vals->rating).'</td><td>'.$vals->description.'</td><td>'.ucfirst($vals->created_at).'</td><td><button class="custom-bn btn btn-primary btn-sx" onclick=postfeedback('.$vals->id.','.$vals->user_id.','.$vals->profile_id.',"user");>Edit</button></td></tr>';    
      }    
      return json_encode($task1);
  }


           
}	
<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB,Auth;
use Session;
use Validator;
use Redirect;
/**
 * Class SlidersController
 * @package App\Http\Controllers\Backend
 */
class SlidersController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function getSliders()
    {  
        $slider = DB::table('sliders')->get();    
       return view('backend.slider.sliders_list', compact('slider')); 
    }

    public function getSlidersStatus($id = null){
        $slider_status = DB::table('sliders')->where('id',$id)->get();
        $active = $slider_status[0]->is_active;
        if ($id != null) 
        {
            if($active=='Y')
            {
                $update_arr = array('is_active' => 'N');
                DB::table('sliders')->where('id', $id)
                    ->update($update_arr);
                     return redirect()->back()->withFlashSuccess(trans("Slider (".$slider_status[0]->title." ) successfully Inactive"));
            }
            else
            {
                $update_arr = array('is_active' => 'Y');
               DB::table('sliders')->where('id', $id)
                    ->update($update_arr);
                    return redirect()->back()->withFlashSuccess(trans("Slider (".$slider_status[0]->title." ) successfully active"));
            }
        }         
    }
    public function getSlidersDelete($id=null){
        $images = \DB::table('sliders')->where('id', $id)->first();
        $file= $images->image;
        if($file == 'no-image.png'){

        }else{        
            $filename = public_path().'/img/slider/'.$file;
            \File::delete($filename);
        }
        DB::table('sliders')->where('id', $id)->delete();
        return redirect()->back()->withFlashSuccess(trans('Slider successfully deleted'));
    }
    public function postSliderSaveFirst()
    {
        echo '<pre>';  print_r($_REQUEST);die;
        $input = Input::all();
        $title = DB::table('sliders')->where('title', $_REQUEST['title'])->get();
        if(count($title)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        {        
            $title = $_REQUEST['title'];
            $description = $_REQUEST['description'];
            $youtube_url = $_REQUEST['youtube_url'];
            $is_status = $_REQUEST['confirmed'];
            if( $input['file'] == 'undefined' )
            {   

                $image = 'no-image.png';        

             }else{
                $newfilename1 = rand(11111,99999).'.'.'png';
                $file_temp = $_FILES['file']['tmp_name'];
                $folder = public_path().'/img/slider/';
                move_uploaded_file($file_temp, $folder.$newfilename1);
                $image = $newfilename1;                 
             }            
            if($is_status == 'true')
            {
                $is_status = 'Y';
            }
            else
            {
                $is_status = 'N';
            }     
            $values = array('title'=>$title, 'description'=>$description, 'url'=>$youtube_url, 'image'=>$image, 'is_active'=>$is_status, 'created_at' => date('Y-m-d H:i:s'));
            $task = DB::table('sliders')->insert($values);
            $slider_arr = DB::table('sliders')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($slider_arr as $key => $vals) {
                $ids = $key+1;
                $task1.=
                "<tr>
                    <td>".$ids."</td>
                    <td>". $vals->title."</td>                   
                    <td>". $vals->created_at."</td>
                    <td>". $vals->updated_at."</td>";
/*                 if($vals->is_active == 'N')
                {                    
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/sliders/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                { 
                    
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/sliders/status/".$vals->id."'>Active</a></td>";
                } */
                    $task1.="<td>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/sliders/delete/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                            
                    </td>";
               $task1.="</tr>";
            }    
            return json_encode($task1);
        }     
    }     
 
    public function getSliderEditForm(){
       $data = DB::table('sliders')->where('id',$_REQUEST['id'])->first();
       return json_encode($data);        
    }
    public function postSliderSave(){
        $input = Input::all();
        $title = DB::table('sliders')->where('title', $_REQUEST['title'])->where('id', !'=', $_REQUEST['id'])->get();
        if(count($title)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        {
            $title = $_REQUEST['title'];
            $description = $_REQUEST['description'];
            $youtube_url = $_REQUEST['youtube_url'];
            $is_status = $_REQUEST['confirmed'];
            $oldimage = DB::table('sliders')->where('id',$_REQUEST['id'])->first();            
            if( $input['file'] == 'undefined' )
            {   
                $image = 'no-image.png';        
                
             }else{
                 $newfilename1 = rand(11111,99999).'.'.'png';
                 $file_temp = $_FILES['file']['tmp_name'];
                 $folder = public_path().'/img/slider/';
                 move_uploaded_file($file_temp, $folder.$newfilename1);
                $image = $newfilename1;
                if(isset($oldimage) && file_exists(public_path().'/img/slider/'.$oldimage->image))
                {
                        unlink(public_path().'/img/slider/'.$oldimage->image);
                }                 
             }            
            if($is_status == 'true')
            {
                $is_status = 'Y';
            }
            else
            {
                $is_status = 'N';
            }           
            $values = array('title'=>$title, 'description'=>$description, 'url'=>$youtube_url, 'image'=>$image, 'is_active'=>$is_status, 'updated_at' => date('Y-m-d H:i:s'));
            $task = DB::table('sliders')->where('id',$_REQUEST['id'])->update($values);
            $slider_arr = DB::table('sliders')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($slider_arr as $key => $vals) {
                $ids = $key+1;
                $task1.=
                "<tr>
                    <td>".$ids."</td>
                    <td>". $vals->title."</td>
                    <td>". $vals->created_at."</td>
                    <td>". $vals->updated_at."</td>";
/*                 if($vals->is_active == 'N')
                { 
                   
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/sliders/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                { 
                    
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/sliders/status/".$vals->id."'>Active</a></td>";
                } */
                  $task1.="<td>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/sliders/delete/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                            
                 </td>";
               $task1.=" </tr>";
            }   
            return json_encode($task1);
        }     
    }     
                    

}

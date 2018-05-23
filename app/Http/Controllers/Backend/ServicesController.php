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
 * Class ServicesController
 * @package App\Http\Controllers\Backend
 */
class ServicesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function getServices()
    {
       $service = DB::table('services')->get();	
       return view('backend.service.services', compact('service')); 
    }
    public function getChangeStatus($id=NULL)
    {
        $changestatus = DB::table('services')->where('id',$id)->first();
        if(isset($changestatus) && !empty($changestatus))
        {
            if($changestatus->is_active == 'Y')
            {
                $values= array('is_active'=> 'N');
                DB::table('services')->where('id',$id)->update($values);
                return redirect('admin/services')->withFlashSuccess('Services successfully Deactive');
            }
            else
            {
                $values= array('is_active'=> 'Y');
                DB::table('services')->where('id',$id)->update($values);
                return redirect('admin/services')->withFlashSuccess('Services successfully Activeted');
            }
        }
    }
    public function getServicesDelete($id = NULL){
        DB::table('services')->where('id', $id)->delete();
		DB::table('user_services')->where('service_id', $id)->delete();
        return redirect('admin/services')->withFlashSuccess(trans('successfully service deleted'));    	
    }
    public function postServiceSaveFirst(){
        $input = Input::all();
        $name = DB::table('services')->where('name', $_REQUEST['name'])->get();
        if(count($name)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        {        
            $name = $_REQUEST['name'];
            $description = $_REQUEST['description'];
            $is_status = $_REQUEST['is_status'];
            if( $input['file'] == 'undefined' )
            {   

                $image = 'no-image.png';        

             }else{
                $newfilename1 = rand(11111,99999).'.'.'png';
                $file_temp = $_FILES['file']['tmp_name'];
                $folder = public_path().'/img/services/';
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
            $values = array('name'=>$name, 'description'=>$description, 'image' => $image, 'is_active'=>$is_status, 'created_at' => date('Y-m-d H:i:s'));
            $task = DB::table('services')->insert($values);
            $services_arr = DB::table('services')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($services_arr as $key => $vals) {
             
                $ids = $key+1;

                $task1.=
                "<tr>
                    <td>".$ids."</td>
                    <td>". ucfirst($vals->name)."</td>
                    <td>". substr($vals->description,'0','30').". . .</td>
                    <td><img style='width: 70px;' src=".asset('img/services')."/".$vals->image." ></td>
                    <td>".$vals->created_at."</td>
                    <td>". $vals->created_at."</td>";
                 if($vals->is_active == 'N')
                { 
                   
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/services/change/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                { 
                    
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/services/change/status/".$vals->id."'>Active</a></td>";
                } 
                
                  $task1.="<td>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/services/delete/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                            
                 </td>";
               $task1.=" </tr>";
            }
            //$task1 = "true";     
            return json_encode($task1);
        }     
    }

    public function getServiceEditForm(){
       $data = DB::table('services')->where('id',$_REQUEST['id'])->first();
       return json_encode($data);        
    }
    public function postServiceSave(){
        $input = Input::all();
        $name = DB::table('services')->where('name', $_REQUEST['name'])->where('id', !'=', $_REQUEST['id'])->get();
        if(count($name)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        { 
            $name = $_REQUEST['name'];
            $description = $_REQUEST['description'];
            $is_status = $_REQUEST['is_status'];
            $oldimage = DB::table('services')->where('id',$_REQUEST['id'])->first();
           /* echo $oldimage->image;
            echo "<pre>"; print_r($oldimage); exit; */           
            if( $input['file'] == 'undefined' )
            {  
                if(empty($oldimage->image))
                {
                     $image = 'no-image.png';        
                }
                else
                {
                    $image = $oldimage->image;
                }
                
             }else{
                 $newfilename1 = rand(11111,99999).'.'.'png';
                 $file_temp = $_FILES['file']['tmp_name'];
                 $folder = public_path().'/img/services/';
                 move_uploaded_file($file_temp, $folder.$newfilename1);
                $image = $newfilename1;
                /*if($oldimage->image != 'no-image.png' )
                {
                    if(isset($oldimage) && file_exists(public_path().'/img/services/'.$oldimage->image))
                    {
                        unlink(public_path().'/img/services/'.$oldimage->image);
                    }
                } */                
             } 
            if($is_status == 'true')
            {
                $is_status = 'Y';
            }
            else
            {
                $is_status = 'N';
            }
            $values = array('name'=>$name, 'description'=>$description, 'image' => $image, 'is_active' => $is_status, 'updated_at' => date('Y-m-d H:i:s'));
            $task = DB::table('services')->where('id',$_REQUEST['id'])->update($values);

            $services_arr = DB::table('services')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($services_arr as $key => $vals) {
                $ids = $key+1;
                $task1.=
                "<tr>
                    <td>".$ids."</td>
                    <td>". ucfirst($vals->name)."</td>
                    <td>". substr($vals->description,'0','30').". . .</td>
                    <td><img style='width: 70px;' src=".asset('img/services')."/".$vals->image." ></td>
                    <td>". $vals->created_at."</td>";
                 if($vals->is_active == 'N')
                { 
                   
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/services/change/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                { 
                    
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/services/change/status/".$vals->id."'>Active</a></td>";
                } 
                
                  $task1.="<td>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/services/delete/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                            
                 </td>";
               $task1.=" </tr>";
             }    
            return json_encode($task1);
        
        }        
    }        

}
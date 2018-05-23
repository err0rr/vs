<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use DB,Auth;
use Session;
use Validator;
use Redirect;
/**
 * Class LanguagesController
 * @package App\Http\Controllers\Backend
 */
class LanguagesController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function language()
    {  
        $languages=DB::table('languages')->get();
        return view('backend.languages.languagelist',compact('languages'));
    }
    public function changeStatus($id=null)
    { 
        $changestatus = DB::table('languages')->where('id',$id)->first();
        if(isset($changestatus) && !empty($changestatus))
        {
            if($changestatus->is_active == 'Y')
            {
                $values= array('is_active' => 'N');
                DB::table('languages')->where('id',$id)->update($values);
                return redirect('/admin/language')->withFlashSuccess('successfully Deactive language');
            }
            else
            {
                $values= array('is_active'=> 'Y');
                DB::table('languages')->where('id',$id)->update($values);
                return redirect('/admin/language')->withFlashSuccess('successfully active language');                
             }
        }         
    }
    public function languageView($id=null)
    {
        $language_view=DB::table('languages')->where('id',$id)->first();
         return view('backend.languages.viewlanguage', compact('language_view'));       
    }
    public function languageDelete($id=null)
    {//echo 'hello'; die;
        $images = \DB::table('languages')->where('id', $id)->first();
        $file = $images->flag;
        if($file == 'no-image.png'){

        }else{
            $filename = public_path().'/img/lang_flag/'.$file;
            \File::delete($filename);     
        }
        DB::table('languages')->where('id', $id)->delete();
        DB::table('user_languages')->where('language_id', $id)->delete();
        return redirect()->back()->withFlashSuccess(trans('successfully deleted'));         
    }
    public function postLanguageSaveFirst(){
        $input = Input::all();
        $name = DB::table('languages')->where('name', $_REQUEST['name'])->get();
        if(count($name)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        {        
            $name = $_REQUEST['name'];
            $is_status = $_REQUEST['confirmed'];
            if( $input['file'] == 'undefined' )
            {   
                $image = 'no-image.png';       
             }else{
                $newfilename1 = rand(11111,99999).'.'.'png';
                $file_temp = $_FILES['file']['tmp_name'];
                $folder = public_path().'/img/lang_flag/';
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
            $values = array('name'=>$name, 'flag'=>$image, 'is_active'=>$is_status, 'created_at' => date('Y-m-d H:i:s'));
            $task = DB::table('languages')->insert($values);
            $language_arr = DB::table('languages')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($language_arr as $key => $vals) {
               
                $ids = $key+1;

                $task1.="<tr><td>".$ids."</td><td>". ucfirst($vals->name)."</td><td>". $vals->flag."</td><td>". $vals->created_at."</td>";
                if($vals->is_active == 'N')
                {
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/language/change/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                { 
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/language/change/status/".$vals->id."'>Active</a></td>";
                } 
                  $task1.="<td>
                        <a href='".$url."/admin/language/view/".$vals->id."' class='btn btn-success btn-xs'><i class='fa fa-eye' data-toggle='tooltip' data-palcement='top' title data-original-title='View'></i></a>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/delete/language/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                            
                 </td>";
               $task1.="</tr>";
            }    
            return json_encode($task1);
        }     
    } 
    public function getLanguageEditForm(){
       $data = DB::table('languages')->where('id',$_REQUEST['id'])->first();
       return json_encode($data);        
    }
    public function postLanguageSave(){
        $input = Input::all();
        $name = DB::table('languages')->where('name', $_REQUEST['name'])->where('id', !'=', $_REQUEST['id'])->get();
        if(count($name)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        { 
            $name = $_REQUEST['name'];
            $is_status = $_REQUEST['confirmed'];
            $oldimage = DB::table('languages')->where('id',$_REQUEST['id'])->first();
            if( $input['file'] == 'undefined' )
            {   
                $image = 'no-image.png';       
                
             }else{
                 $newfilename1 = rand(11111,99999).'.'.'png';
                 $file_temp = $_FILES['file']['tmp_name'];
                 $folder = public_path().'/img/lang_flag/';
                 move_uploaded_file($file_temp, $folder.$newfilename1);
                $image = $newfilename1;
                if(isset($oldimage) && file_exists(public_path().'/img/lang_flag/'.$oldimage->flag))
                {
                        unlink(public_path().'/img/lang_flag/'.$oldimage->flag);
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
            $values = array('name'=>$name, 'flag'=>$image, 'is_active' => $is_status, 'updated_at' => date('Y-m-d H:i:s'));
            $task = DB::table('languages')->where('id',$_REQUEST['id'])->update($values);
            $language_arr = DB::table('languages')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($language_arr as $key => $vals) {
                $ids = $key+1;
                $task1.=
                "<tr>
                    <td>".$ids."</td>
                    <td>". ucfirst($vals->name)."</td>
                    <td>". $vals->flag."</td>
                    <td>". $vals->created_at."</td>";
                 if($vals->is_active == 'N')
                {          
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/language/change/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                {         
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/language/change/status/".$vals->id."'>Active</a></td>";
                } 
                  $task1.="<td>
                        <a href='".$url."/admin/language/view/".$vals->id."' class='btn btn-success btn-xs'><i class='fa fa-eye' data-toggle='tooltip' data-palcement='top' title data-original-title='View'></i></a>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/delete/language/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                       
                 </td>";
               $task1.=" </tr>";
            }    
            return json_encode($task1);
        }     
    }           

}
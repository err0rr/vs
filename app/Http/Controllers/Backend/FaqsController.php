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
class FaqsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function faqs()
    {  
    	$faqs=DB::table('faqs')->get();
    	return view('backend.faqs.faqs',compact('faqs')); 
    }
    public function changeStatus($id=null)
    {
              $changestatus = DB::table('faqs')->where('id',$id)->first();
        if(isset($changestatus) && !empty($changestatus))
        {
            if($changestatus->is_active == 'Y')
            {
                $values= array('is_active'=> 'N');
                DB::table('faqs')->where('id',$id)->update($values);
                return redirect('admin/faqs')->withFlashSuccess('successfully Deactive faqs id  '.$id.'');
            }
            else
            {
                $values= array('is_active'=> 'Y');
                DB::table('faqs')->where('id',$id)->update($values);
                return redirect('admin/faqs')->withFlashSuccess('successfully active faqs id  '.$id.'');                
             }
        }    	
    }


    public function faqsView($id=null)
    {
    	$faqs_view=DB::table('faqs')->where('id',$id)->first();
    	 return view('backend.faqs.faqsview', compact('faqs_view'));
    }

    public function FaqsDelete($id=null)
    {
        DB::table('faqs')->where('id',$id)->delete();
         return redirect()->back()->withFlashSuccess(trans('successfully deleted'));    	
    }

    public function postFaqsSaveFirst(){

        $question = DB::table('faqs')->where('question', $_REQUEST['question'])->get();
        if(count($question)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        {        
            $question = $_REQUEST['question'];
            $answer = $_REQUEST['answer'];
            $is_status = $_REQUEST['is_status'];
            if($is_status == 'true')
            {
                $is_status = 'Y';
            }
            else
            {
                $is_status = 'N';
            }     
            $values = array('question'=>$question, 'answer'=>$answer, 'is_active'=>$is_status, 'created_at' => date('Y-m-d H:i:s'));
            $task = DB::table('faqs')->insert($values);
            $faqs_arr = DB::table('faqs')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($faqs_arr as $key => $vals) {
                $ids = $key+1;
                $task1.=
                "<tr>
                    <td>".$ids."</td>
                    <td>". substr($vals->question,'0','20').".?</td>
                    <td>". substr($vals->answer, '0', '20').".....</td>
                   
                    <td>". $vals->created_at."</td>";
                 if($vals->is_active == 'N')
                { 
                   
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/faqs/change/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                { 
                    
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/faqs/change/status/".$vals->id."'>Active</a></td>";
                } 
                  $task1.="<td>
                        <a href='".$url."/admin/faqs/view/".$vals->id."' class='btn btn-success btn-xs'><i class='fa fa-eye' data-toggle='tooltip' data-palcement='top' title data-original-title='View'></i></a>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/delete/faqs/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                            
                 </td>";
               $task1.=" </tr>";
            }
            //$task1 = "true";     
            return json_encode($task1);
        }     
    } 
    public function getFaqsEditForm(){
       $data = DB::table('faqs')->where('id',$_REQUEST['id'])->first();
       return json_encode($data);        
    }
    public function postFaqsSave(){
        $question = DB::table('faqs')->where('question', $_REQUEST['question'])->where('id', !'=', $_REQUEST['id'])->get();
        if(count($question)>0)
        {
            $task1 = "false";
            return json_encode($task1);
        }
        else
        { 
            $question = $_REQUEST['question'];
            $answer = $_REQUEST['answer'];
            $is_status = $_REQUEST['is_status'];
            if($is_status == 'true')
            {
                $is_status = 'Y';
            }
            else
            {
                $is_status = 'N';
            }
            $values = array('question'=>$question,'answer'=>$answer, 'is_active' => $is_status, 'updated_at' => date('Y-m-d H:i:s'));
            $task = DB::table('faqs')->where('id',$_REQUEST['id'])->update($values);
            $faqs_arr = DB::table('faqs')->get();
            $url=URL('/');
            $task1 = '';
            foreach ($faqs_arr as $key => $vals) {
               // echo $vals->is_active; die;
                $ids = $key+1;

                $task1.=
                "<tr>
                    <td>".$ids."</td>
                    <td>". substr($vals->question,'0','20').".?</td>
                    <td>". substr($vals->answer, '0', '25').".....</td>
                
                    <td>". $vals->created_at."</td>";
                 if($vals->is_active == 'N')
                { 
                   
                    $task1.="<td><a class='btn btn-xs btn-danger' href='".$url."/admin/faqs/change/status/".$vals->id."'>Inactive</a></td>";
                }
                else  
                { 
                    
                    $task1.= "<td><a class='btn btn-xs btn-primary' href='".$url."/admin/faqs/change/status/".$vals->id."'>Active</a></td>";
                } 
                  $task1.="<td>
                        <a href='".$url."/admin/faqs/view/".$vals->id."' class='btn btn-success btn-xs'><i class='fa fa-eye' data-toggle='tooltip' data-palcement='top' title data-original-title='View'></i></a>
                        <button class='btn btn-warning btn-xs btn-detail open-modal' id='idsav' value='".$vals->id."'>Edit</button>                 
                        <a href='".$url."/admin/delete/faqs/".$vals->id."' onclick='return confirm('Are you sure you want to delete this Service?')' class='btn btn-xs btn-danger'><i class='fa fa-trash' data-toggle='tooltip' data-palcement='top' title data-original-title='Delete'></i></a>                                            
                 </td>";
               $task1.=" </tr>";
            }
            //$task1 = "true";     
            return json_encode($task1);
        }     
    }     
}	
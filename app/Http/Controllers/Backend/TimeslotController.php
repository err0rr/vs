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
class TimeslotController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    public function listtimeslot()
    {  
    	$timeslot = DB::table('available_time_slot_master')->get();
    	return view('backend.timeslot.listtimeslot',compact('timeslot')); 
    }
    public function changeStatus($id=null)
    {
        
        $changestatus = DB::table('available_time_slot_master')->where('id',$id)->first();
        if(isset($changestatus) && !empty($changestatus))
        {
            if($changestatus->is_active == 'Y')
            {
                $values= array('is_active'=> 'N');
                DB::table('available_time_slot_master')->where('id',$id)->update($values);
                return redirect('admin/listtimeslot')->withFlashSuccess('successfully Deactive time sloat id  '.$id.'');
            }
            else
            {
                $values= array('is_active'=> 'Y');
                DB::table('available_time_slot_master')->where('id',$id)->update($values);
                return redirect('admin/listtimeslot')->withFlashSuccess('successfully active time sloat id  '.$id.'');                
             }
        }    	
    }

    public function addtimeslot(){

       return view('backend.timeslot.addtimeslot'); 
    }

    public function storetimeslot(){
        $input = Input::all();

            $start_time = $input['start_time'];
            $end_time = $input['end_time'];
            $stime = array($start_time, $end_time);

        // $isbetween = DB::table('available_time_slot_master')
        //             ->whereBetween('start_time', $stime)
        //             ->orWhereBetween('end_time', $stime)
        //             ->get();
        $isbetween_and = DB::table('available_time_slot_master')
                        ->whereRaw("(available_time_slot_master.start_time <= '".$start_time."' AND available_time_slot_master.end_time > '".$start_time."') OR (available_time_slot_master.start_time < '".$end_time."' AND available_time_slot_master.end_time >= '".$end_time."')")
                        ->get();

        if(empty($isbetween_and)){
            if(!empty($input['start_time']) AND !empty($input['end_time'])){

                $created_at = date('Y-m-d H:i:s');

                $insert_arr = array('start_time'=> $start_time, 'end_time'=> $end_time, 'is_active'=>'Y', 'created_at' => $created_at);
                DB::table('available_time_slot_master')->insert($insert_arr);
            }else{
                return redirect()->back()->withFlashSuccess(trans("Some error occured Please enter values again"));
            }
            return redirect()->to('admin/listtimeslot')->withFlashSuccess(trans("add successfully"));
        }else{
            return redirect()->back()->withFlashSuccess(trans("this time slot is already add"));
        }
        // return view('backend.timeslot.listtimeslot'); 
    }

    public function timeslotDelete($id=null){
        $timeslot = DB::table('available_time_slot_master')->where('id',$id)->first();
        if(isset($timeslot) && !empty($timeslot))
        {
            DB::table('available_time_slot_master')->where('id', $id)->delete();
            return redirect()->back()->withFlashSuccess(trans("Time slot deleted successfully"));
        }else{
            return redirect()->back()->withFlashSuccess(trans("Some error occured Please try again"));
        }

    }

    public function edittimeslot($id=null){
        $timeslot_arr = DB::table('available_time_slot_master')->where('id',$id)->first();
        if(isset($timeslot_arr) && !empty($timeslot_arr))
        {
            

            return view('backend.timeslot.edittimeslot', compact('timeslot_arr'));


        }else{
            return redirect()->back()->withFlashSuccess(trans("Some error occured Please try again"));
        }
    }

    public function entertimeslot($id=null){

        $input = Input::all();
        $start_time = $input['start_time'];
        $end_time = $input['end_time'];
        $stime = array($start_time, $end_time);

        // $isbetween = DB::table('available_time_slot_master')
        //             ->where('id','!=', $id)->whereRaw("( available_time_slot_master.start_time between '".$start_time."' and '".$end_time."' or available_time_slot_master.end_time between '".$start_time."' and '".$end_time."')")
        //             // ->WhereBetween('start_time', $stime)
        //             // ->orWhereBetween('end_time', $stime)
        //             ->get();

        DB::enableQueryLog();
        $isbetween_and = DB::table('available_time_slot_master')
                        ->where('id','!=', $id)
                        ->whereRaw("(available_time_slot_master.start_time <= '".$start_time."' AND available_time_slot_master.end_time > '".$start_time."') OR (available_time_slot_master.start_time < '".$end_time."' AND available_time_slot_master.end_time >= '".$end_time."')")
                        ->get();

// dd(DB::getQueryLog()); 
// dd($isbetween_and);
        if(empty($isbetween_and)){
            if(!empty($input['start_time']) AND !empty($input['end_time'])){

                $start_time = $input['start_time'];
                $end_time = $input['end_time'];
                $updated_at = date('Y-m-d H:i:s');

                $insert_arr = array('start_time'=> $start_time, 'end_time'=> $end_time, 'is_active'=>'Y', 'updated_at' => $updated_at);
                    DB::table('available_time_slot_master')->where('id', $id)->update($insert_arr);
                return redirect()->to('admin/listtimeslot')->withFlashSuccess(trans("Time slot updated successfully"));
            }else{
                return redirect()->back()->withFlashSuccess(trans("Some error occured Please enter values again"));
            }
        }else{
            return redirect()->back()->withFlashSuccess(trans("this time slot is already add"));
        }
        // return view('backend.timeslot.listtimeslot'); 
    }
}	
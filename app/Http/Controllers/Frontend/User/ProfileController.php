<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use DB,Auth;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Frontend
 */
class ProfileController extends Controller
{
    /**
     * @return mixed
     */
    public function edit()
    {
        $Language_arr=DB::table('languages')->where('is_active','Y')->get();
        $Service_arr=DB::table('services')->where('is_active','Y')->get();
        $user_Service_arr=DB::table('user_services')->where('user_id',access()->user()->id)->get();
        $user_Language_arr=DB::table('user_languages')->where('user_id',access()->user()->id)->get();
        $user_info_arr=DB::table('user_informations')->where('user_id',access()->user()->id)->first();
        //print_r((array) $user_Language_arr); die;
        return view('frontend.user.profile.edit',compact('Language_arr','Service_arr','user_Language_arr','user_Service_arr','user_info_arr'))
            ->withUser(access()->user());
    }

    /**
     * @param  UserRepositoryContract         $user
     * @param  UpdateProfileRequest $request
     * @return mixed
     */
    public function update(UserRepositoryContract $user, UpdateProfileRequest $request)
    {
        //echo "<pre>";print_r($_REQUEST);exit;
        $user->updateProfile(access()->id(), $request->all());
        return redirect()->route('frontend.user.dashboard')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }
    /*public function postescortRateUpdate()
    {
        if(!empty($_REQUEST['date']))
        {
            $date = explode('-', $_REQUEST['date']); 
            $date1 =  $date[2].'-'.$date[0].'-'.$date[1];
            $update_arr = array('user_id' => Auth::User()->id, 'date' => $date1, 'rate_15m' => $_REQUEST['15m'], 'rate_30m' => $_REQUEST['30m'], 'rate_1h' => $_REQUEST['1hr'], 'rate_1d' => $_REQUEST['1d']);

            $con = array('user_id' => Auth::User()->id, 'date' => $date1);
            $userDate = DB::table('user_prices')->where($con)->first();

            if(!empty($userDate))
            {
                DB::table('user_prices')->where('id', $userDate->id)->update($update_arr);
            }
            else
            {
                DB::table('user_prices')->insert($update_arr);
            }
        }
        else
        {
            $update_arr = array('rate_15m' => $_REQUEST['15m'], 'rate_30m' => $_REQUEST['30m'], 'rate_1h' => $_REQUEST['1hr'], 'rate_1d' => $_REQUEST['1d']);
            DB::table('user_informations')->where('user_id', Auth::User()->id)->update($update_arr);
        }
        return redirect()->back();
    }*/

    public function getChangePrice()
    {
        if(!empty($_REQUEST['date']))
        {   
            $date_arr = explode(',',$_REQUEST['date']);
            foreach ($date_arr as $key => $value) {
                $date = explode('-', $value); 
                $date1 =  $date[2].'-'.$date[0].'-'.$date[1];
                $update_arr = array('user_id' => Auth::User()->id, 'date' => $date1, 'rate_15m' => $_REQUEST['m15'], 'rate_30m' => $_REQUEST['m30'], 'rate_1h' => $_REQUEST['hr1'], 'rate_1d' => $_REQUEST['d1']);

                $con = array('user_id' => Auth::User()->id, 'date' => $date1);
                $userDate = DB::table('user_prices')->where($con)->first();

                if(!empty($userDate))
                {
                    DB::table('user_prices')->where('id', $userDate->id)->update($update_arr);
                }
                else
                {
                    DB::table('user_prices')->insert($update_arr);
                }
            }
        }
        else
        {
            $update_arr = array('rate_15m' => $_REQUEST['m15'], 'rate_30m' => $_REQUEST['m30'], 'rate_1h' => $_REQUEST['hr1'], 'rate_1d' => $_REQUEST['d1']);
            DB::table('user_informations')->where('user_id', Auth::User()->id)->update($update_arr);
        }
        return "true";
    }
}
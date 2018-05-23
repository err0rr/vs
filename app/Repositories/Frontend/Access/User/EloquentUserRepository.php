<?php

namespace App\Repositories\Frontend\Access\User;

use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Hash;
use App\Models\Access\User\SocialLogin;
use App\Events\Frontend\Auth\UserConfirmed;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;


/**
 * Class EloquentUserRepository
 * @package App\Repositories\Frontend\User
 */
class EloquentUserRepository implements UserRepositoryContract
{

    /**
     * @var RoleRepositoryContract
     */
    protected $role;

    /**
     * @param RoleRepositoryContract $role
     */
    public function __construct(RoleRepositoryContract $role)
    {
        $this->role = $role;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @param $email
     * @return bool
     */
    public function findByEmail($email) {
        $user = User::where('email', $email)->first();

        if ($user instanceof User)
            return $user;

        return false;
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function findByToken($token) {
        $user = User::where('confirmation_code', $token)->first();

        if (! $user instanceof User)
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.not_found'));

        return $user;
    }

	/**
	 * TODO: Move this somewhere more appropriate
	 * @param $token
	 * @return mixed
	 * @throws GeneralException
	 */
	public function getEmailForPasswordToken($token) {
		if ($row = DB::table('password_resets')->where('token', $token)->first())
			return $row->email;
		throw new GeneralException(trans('auth.unknown'));
	}

    /**
     * @param array $data
     * @param bool $provider
     * @return static
     */
    public function create(array $data, $provider = false)
    {
        //print_r($data['userimage']); die;
       //echo "<pre>"; print_r($data); die;
    	$user = new User;
		$user->name = $data['name'];
        $user->email = $data['email'];
		$user->user_type = $data['user_type'];
        if($data['user_type']=='Escort')
        {
             $user->phone = $data['phone']; 
               
            if(!empty($_FILES['pic']))
            {
                $file = $_FILES['pic'];                 
                $imagename = $file['name'];
                $newfilename1 = rand(11111,99999).'_'.$imagename;
                $fmove = move_uploaded_file($file['tmp_name'],public_path() . '/img/users/'.$newfilename1);
                $user->photo = $newfilename1;           
            }
            
        }
		$user->confirmation_code = md5(uniqid(mt_rand(), true));
		$user->status = 1;
		$user->password = $provider ? null : bcrypt($data['password']);
		$user->confirmed = $provider ? 1 : (config('access.users.confirm_email') ? 0 : 1);

		DB::transaction(function() use ($user) {
			if ($user->save()) {
				/**
				 * Add the default site role to the new user
				 */
				$user->attachRole($this->role->getDefaultUserRole());
                if($_REQUEST['user_type']=='Escort')
                {   
                    $insert_arr=array('canton'=>$_REQUEST['canton'],'sexuality'=>$_REQUEST['sexuality'],'user_id'=>$user->id,'message'=>$_REQUEST['message']);
                    DB::table('user_informations')->insert($insert_arr);
                }
			}
		});

		/**
		 * If users have to confirm their email and this is not a social account,
		 * send the confirmation email
		 *
		 * If this is a social account they are confirmed through the social provider by default
		 */
		if (config('access.users.confirm_email') && $provider === false) {
			$this->sendConfirmationEmail($user);
		}

		/**
		 * Return the user object
		 */
		return $user;
    }

    /**
     * @param $data
     * @param $provider
     * @return EloquentUserRepository
     */
    public function findOrCreateSocial($data, $provider)
    {
        /**
         * User email may not provided.
         */
        $user_email = $data->email ? : "{$data->id}@{$provider}.com";

        /**
         * Check to see if there is a user with this email first
         */
        $user = $this->findByEmail($user_email);

        /**
         * If the user does not exist create them
         * The true flag indicate that it is a social account
         * Which triggers the script to use some default values in the create method
         */
        if (! $user) {
            $user = $this->create([
                'name'  => $data->name,
                'email' => $user_email,
            ], true);
        }

        /**
         * See if the user has logged in with this social account before
         */
        if (! $user->hasProvider($provider)) {
            /**
             * Gather the provider data for saving and associate it with the user
             */
            $user->providers()->save(new SocialLogin([
                'provider'    => $provider,
                'provider_id' => $data->id,
                'token'       => $data->token,
                'avatar'      => $data->avatar,
            ]));
        } else {
            /**
             * Update the users information, token and avatar can be updated.
             */
            $user->providers()->update([
                'token'       => $data->token,
                'avatar'      => $data->avatar,
            ]);
        }

        /**
         * Return the user object
         */
        return $user;
    }

    /**
     * @param $token
     * @return bool
     * @throws GeneralException
     */
    public function confirmAccount($token)
    {
        $user = $this->findByToken($token);

        if ($user->confirmed == 1) {
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        if ($user->confirmation_code == $token) {
            $user->confirmed = 1;

			event(new UserConfirmed($user));
            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.confirmation.mismatch'));
    }

	/**
     * @param $user
     * @return bool
     * @throws GeneralException
     */
    public function sendConfirmationEmail($user)
    {
        //$user can be user instance or id
        if (! $user instanceof User) {
            $user = $this->find($user);
        }
        if($user->user_type == 'Member'){
            Mail::send('frontend.auth.emails.confirm', ['name'=> $user->name, 'token' => $user->confirmation_code], function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('exceptions.frontend.auth.confirmation.confirm'));
            });
        }else{
            Mail::send('frontend.auth.emails.escortconfirm', ['name'=> $user->name, 'token' => $user->confirmation_code], function ($message) use ($user) {
            $message->to($user->email, $user->name)->subject(app_name() . ': ' . trans('exceptions.frontend.auth.confirmation.confirm'));
            });
        }
        if (count(Mail::failures()) > 0) {
            throw new GeneralException("There was a problem sending the confirmation e-mail");
        }

        return true;
    }

    /**
     * @param $user_id
     * @return mixed
     * @throws GeneralException
     */
    public function resendConfirmationEmail($user_id) {
        return $this->sendConfirmationEmail($this->find($user_id));
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function updateProfile($id, $input)
    {
        //echo 'hii'; die;
        $user = $this->find($id);
        $user->name = $input['name'];
        $user->phone = $input['phone'];
        $oldimage = DB::table('users')->where('id',$id)->first();
        if(!empty($file =Input::file('photo')))
        {
            $name_image = $file->getClientOriginalExtension() ?:'png';
            $newfilename1 = rand(11111,99999).'.'.$name_image;
            $fmove = $file->move(public_path() . '/img/users/',  $newfilename1);
            $user->photo = $newfilename1;
            if(isset($oldimage) && file_exists(public_path().'/img/users/'.$oldimage->photo))
                {
                    if($oldimage->photo != "noimage.jpg"){
                        unlink(public_path().'/img/users/'.$oldimage->photo);
                    }
                } 
        }
        else
        {
            $user->photo ="noimage.jpg" ;
        }
        if ($user->canChangeEmail()) {
            //Address is not current address
            if ($user->email != $input['email']) {
                //Emails have to be unique
                if ($this->findByEmail($input['email'])) {
                    throw new GeneralException(trans('exceptions.frontend.auth.email_taken'));
                }

                $user->email = $input['email'];
            }
        }
        if($input['user_type']=="Escort")
        {
            if(isset($input['language']) && count($input['language'])>0)
            {
                DB::table('user_languages')->where('user_id',$id)->delete();
                foreach($input['language'] as $lv)
                {
                    $insert_arr=array('user_id'=>$id,'language_id'=>$lv);
                    DB::table('user_languages')->insert($insert_arr);
                }
            }
            if(isset($input['service']) && count($input['service'])>0)
            {
                DB::table('user_services')->where('user_id',$id)->delete();
                foreach($input['service'] as $lv)
                {
                    $insert_arr=array('user_id'=>$id,'service_id'=>$lv);
                    DB::table('user_services')->insert($insert_arr);
                }
            }
            //echo "<pre>";print_r($_REQUEST);exit;
            $this->saveprofileinfo($id,$input);
        }

        return $user->save();
    }

    public function saveprofileinfo($id,$input)
    {
        
        $checkentry=DB::table('user_informations')->where('user_id',$id)->first();
       // print_r($checkentry);exit;
        if(count($checkentry)>0)
        {
            $insert_arr=array(
        'message'=>isset($input['message']) ? $input['message'] : $checkentry->message,
        'canton'=>isset($input['canton']) ? $input['canton'] : $checkentry->canton,
        'region'=>isset($input['region']) ? $input['region'] : $checkentry->region,
        'area'=>isset($input['area']) ? $input['area'] : $checkentry->area,
        'type'=>isset($input['type']) ? $input['type'] : $checkentry->type,
        'nationality'=>isset($input['nationality']) ? $input['nationality'] : $checkentry->nationality,
        'ethnicity'=>isset($input['ethnicity']) ? $input['ethnicity'] : $checkentry->ethnicity,
        'age'=>isset($input['age']) ? $input['age'] : $checkentry->age,
        'sexuality'=>isset($input['sexuality']) ? $input['sexuality'] : $checkentry->sexuality,
        'weight'=>isset($input['weight']) ? $input['weight'] : $checkentry->weight,
        'height'=>isset($input['height']) ? $input['height'] : $checkentry->height,
        'eyes'=>isset($input['eyes']) ? $input['eyes'] : $checkentry->eyes,
        'hair'=>isset($input['hair']) ? $input['hair'] : $checkentry->hair,
        'shoe_size'=>isset($input['shoe_size']) ? $input['shoe_size'] : $checkentry->shoe_size,
        'breast_size'=>isset($input['breast_size']) ? $input['breast_size'] : $checkentry->breast_size,
        'pubic_hair'=>isset($input['pubic_hair']) ? $input['pubic_hair'] : $checkentry->pubic_hair,
        'appointment'=>isset($input['appointment']) ? $input['appointment'] : $checkentry->appointment,
        'service_for'=>isset($input['service_for']) ? $input['service_for'] : $checkentry->service_for,
        'instruction'=>isset($input['instruction']) ? $input['instruction'] : $checkentry->instruction,
        'minimum_rate'=>isset($input['minimum_rate']) ? $input['minimum_rate'] : $checkentry->minimum_rate,
        'currency'=>isset($input['currency']) ? $input['currency'] : "",
        );
             $infoid=$checkentry->id;
             DB::table('user_informations')->where('id',$infoid)->update($insert_arr);
        }
        else{
            $insert_arr=array(
        'message'=>isset($input['message']) ? $input['message'] : "",
        'canton'=>isset($input['canton']) ? $input['canton'] : "",
        'region'=>isset($input['region']) ? $input['region'] : "",
        'area'=>isset($input['area']) ? $input['area'] : "",
        'type'=>isset($input['type']) ? $input['type'] : "",
        'nationality'=>isset($input['nationality']) ? $input['nationality'] : "",
        'ethnicity'=>isset($input['ethnicity']) ? $input['ethnicity'] : "",
        'age'=>isset($input['age']) ? $input['age'] : "",
        'sexuality'=>isset($input['sexuality']) ? $input['sexuality'] : "",
        'weight'=>isset($input['weight']) ? $input['weight'] : "",
        'height'=>isset($input['height']) ? $input['height'] : "",
        'eyes'=>isset($input['eyes']) ? $input['eyes'] : "",
        'hair'=>isset($input['hair']) ? $input['hair'] : "",
        'shoe_size'=>isset($input['shoe_size']) ? $input['shoe_size'] : "",
        'breast_size'=>isset($input['breast_size']) ? $input['breast_size'] : "",
        'pubic_hair'=>isset($input['pubic_hair']) ? $input['pubic_hair'] : "",
        'appointment'=>isset($input['appointment']) ? $input['appointment'] : "",
        'service_for'=>isset($input['service_for']) ? $input['service_for'] : "",
        'instruction'=>isset($input['instruction']) ? $input['instruction'] : "",
        'minimum_rate'=>isset($input['minimum_rate']) ? $input['minimum_rate'] : "",
        'currency'=>isset($input['currency']) ? $input['currency'] : "",
        );
          $insert_arr['user_id']=$id;
          DB::table('user_informations')->insert($insert_arr);
        }
        return true;
        
    }

    /**
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function changePassword($input)
    {
        $user = $this->find(access()->id());

        if (Hash::check($input['old_password'], $user->password)) {
            $user->password = bcrypt($input['password']);
            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.password.change_mismatch'));
    }
}
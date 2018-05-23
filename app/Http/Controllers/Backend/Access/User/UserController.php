<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Models\Access\User\User;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\ManageUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserRequest;
use App\Repositories\Backend\Access\User\UserRepositoryContract;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use App\Http\Requests\Backend\Access\User\UpdateUserPasswordRequest;
use App\Repositories\Frontend\Access\User\UserRepositoryContract as FrontendUserRepositoryContract;
use DB,File;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * @var UserRepositoryContract
     */
    protected $users;

    /**
     * @var RoleRepositoryContract
     */
    protected $roles;

    /**
     * @param UserRepositoryContract $users
     * @param RoleRepositoryContract $roles
     */
    public function __construct(UserRepositoryContract $users, RoleRepositoryContract $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

	/**
     * @param ManageUserRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageUserRequest $request)
    {
        return view('backend.access.index');
    }

	/**
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function get(ManageUserRequest $request) {
        return Datatables::of($this->users->getForDataTable($request->get('status'), $request->get('trashed')))
            ->editColumn('confirmed', function($user) {
                return $user->confirmed_label;
            })
            ->addColumn('roles', function($user) {
                $roles = [];

                if ($user->roles()->count() > 0) {
                    foreach ($user->roles as $role) {
                        array_push($roles, $role->name);
                    }

                    return implode("<br/>", $roles);
                } else {
                    return trans('labels.general.none');
                }
            })
            ->addColumn('actions', function($user) {
                return $user->action_buttons;
            })
            ->make(true);
    }

	/**
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function create(ManageUserRequest $request)
    {
        return view('backend.access.create')
            ->withRoles($this->roles->getAllRoles('sort', 'asc', true));
    }

	/**
     * @param StoreUserRequest $request
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create(
            $request->except('assignees_roles'),
            $request->only('assignees_roles')
        );
        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

	/**
     * @param User $user
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function edit(User $user, ManageUserRequest $request)
    {
        return view('backend.access.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->lists('id')->all())
            ->withRoles($this->roles->getAllRoles('sort', 'asc', true));
    }
    /**
     * @param User $user
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function userView(User $user, ManageUserRequest $request)
    { 
        // $user_view = DB::table('users')
        //     ->join('user_informations', 'users.id', '=', 'user_informations.user_id')
        //     ->leftjoin('user_languages', 'users.id', '=', 'user_languages.user_id')
        //     ->leftjoin('user_services', 'users.id', '=', 'user_services.user_id')
        //     ->leftjoin('user_images', 'users.id', '=', 'user_images.user_id')
        //     ->select('users.*', 'user_informations.*', 'user_services.*', 'user_languages.*', 'user_images.*')
        //     ->get();
       
        //         echo '<pre>'; print_r($user_view); die;
        //     return view('backend.access.userview', compact('user_view'));

        //echo '<pre>'; print_r($request); die;
         $user_view = DB::table('users')->where('id', $user->id)->first();
         $user_view_img = DB::table('user_images')->where('user_id', $user->id)->get();
         $user_view_info = DB::table('user_informations')->where('user_id', $user->id)->first();
         $user_view_serv = DB::table('user_services')
            ->join('services', 'user_services.service_id', '=', 'services.id')
            ->where('user_id', $user->id)->get();
         $user_view_lang = DB::table('user_languages')
            ->join('languages', 'user_languages.language_id', '=', 'languages.id')
            ->select('user_languages.*', 'languages.name', 'languages.flag')
            ->where('user_languages.user_id', $user->id)->get();
         //echo '<pre>'; print_r($user_view_lang); die;
             //echo '<pre>'; print_r($user_view);
             //echo '<pre>'; print_r($user_view_img);
             //echo '<pre>'; print_r($user_view_info);
             //echo '<pre>'; print_r($user_view_serv); 
             //echo '<pre>'; print_r($user_view_lang); die;
          return view('backend.access.userview', compact('user_view', 'user_view_img', 'user_view_info', 'user_view_serv', 'user_view_lang'));

    }    

	/**
     * @param User $user
     * @param UpdateUserRequest $request
     * @return mixed
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $this->users->update($user,
            $request->except('assignees_roles'),
            $request->only('assignees_roles')
        );
        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

	/**
     * @param User $user
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function destroy(User $user, ManageUserRequest $request)
    { 
        $this->users->destroy($user);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }

	/**
     * @param User $deletedUser
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function delete(User $deletedUser, ManageUserRequest $request)
    { //echo '<pre>'; print_r($deletedUser->id); die;
        $image = DB::table('user_images')->where('id', $deletedUser->id)->get();
        if(!empty($image)){
            foreach ($image as $img) {
                $file= $img->filename;
                $filename = public_path().'/img/users/'.$file;       
                File::delete($filename);            
            }
        }
        DB::table('user_images')->where('user_id', $deletedUser->id)->delete();
        DB::table('user_informations')->where('user_id', $deletedUser->id)->delete();
        DB::table('user_languages')->where('user_id', $deletedUser->id)->delete();
        DB::table('user_services')->where('user_id', $deletedUser->id)->delete();
        DB::table('assigned_roles')->where('user_id', $deletedUser->id)->delete();
        DB::table('reviews')->where('user_id', $deletedUser->id)->delete();
        $image = DB::table('users')->where('id', $deletedUser->id)->first();        
        $file= $image->photo;
        if($file != "noimage.jpg"){
            $filename = public_path().'/img/users/'.$file;       
            File::delete($filename);            
        }       
        $this->users->delete($deletedUser);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted_permanently'));
    }

	/**
     * @param User $deletedUser
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function restore(User $deletedUser, ManageUserRequest $request)
    {
        $this->users->restore($deletedUser);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.restored'));
    }

	/**
     * @param User $user
     * @param $status
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function mark(User $user, $status, ManageUserRequest $request)
    {
        $this->users->mark($user, $status);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

	/**
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function deactivated(ManageUserRequest $request)
    {
        return view('backend.access.deactivated');
    }

	/**
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function deleted(ManageUserRequest $request)
    {   //echo 'hi1'; die;
        return view('backend.access.deleted');
    }

	/**
     * @param User $user
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function changePassword(User $user, ManageUserRequest $request)
    {
        return view('backend.access.change-password')
            ->withUser($user);
    }

	/**
     * @param User $user
     * @param UpdateUserPasswordRequest $request
     * @return mixed
     */
    public function updatePassword(User $user, UpdateUserPasswordRequest $request)
    {
        $this->users->updatePassword($user, $request->all());
        return redirect()->route('admin.access.user.index')->withFlashSuccess(trans('alerts.backend.users.updated_password'));
    }

	/**
     * @param User $user
     * @param FrontendUserRepositoryContract $user_repository
     * @param ManageUserRequest $request
     * @return mixed
     */
    public function resendConfirmationEmail(User $user, FrontendUserRepositoryContract $user_repository, ManageUserRequest $request)
    {
		$user_repository->sendConfirmationEmail($user);
        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.confirmation_email'));
    }

	/**
	 * @param User $user
	 * @param ManageUserRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function loginAs(User $user, ManageUserRequest $request) {
        return $this->users->loginAs($user);
    }

	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logoutAs() {
        return $this->users->logoutAs();
    }
}
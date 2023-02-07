<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Redirect;
use Validator;


class UserController extends Controller
{
    public function index(Request $request)
    {
        if(Sentinel::check())
            return Redirect::route('dashboard');
        try {
            \DB::connection()->getPdo();
        }catch(\Exception $e){
            \Log::info($e);
            return View('user.login')->with('error','Could not connect to the database');
        }
        return View('user.login');
    }

    public function loginAdmin(Request $request){

        try {
            \DB::connection()->getPdo();
        }catch(\Exception $e){
            return View('user.login')->with('error','Could not connect to the database');
        }

        try {
            $rules = array(
                'email'     => 'required',
                'password'  => 'required|between:3,32'
            );

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                // Ooops.. something went wrong
                return Redirect::route('login')->with('error','Please input email');
            }

            // Try to log the User in
            if (Sentinel::authenticate($request->only(['email','password'])))
            {
                // Redirect to the Dashboard page
                return Redirect::route('dashboard')->with('success', 'Welcome Sign in this System');
            }
            return Redirect::route('login')->with('error', 'Incorrect user or password');

        } catch (NotActivatedException $e) {
            return Redirect::route('login')->with('error', 'User can not login');

        } catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            //\Log::info($e->getMessage());

        } catch (\Exception $e){

            //\Log::info($e->getMessage());
        }

        return back()->withInput()->withErrors('error','User can not login');
    }

    public function getLogout()
    {
        // Log the User out
        Sentinel::logout();
        // Redirect to the first page
        return Redirect::route('login');
    }

    public function profile(Request $request){

        try {
            $user_id = '';
            if(\Sentinel::check()) {
                $user_id = \Sentinel::getUser()->id;
            }
            \DB::beginTransaction();
            $user = DB::table('users as u')
                ->join('role_users as ru', 'ru.user_id', '=', 'u.id')
                ->join('roles as r', 'r.id', '=', 'ru.role_id')
                ->join('activations as a', 'a.user_id', '=', 'u.id')
                ->select('u.*','r.slug','r.id as role_id')
                ->where('u.id',$user_id)
                ->first();

            \DB::commit();

            return view('user.profile',compact('user'));
        }catch(\Exception $e){
            \DB::rollBack();
            return back()->with('error', "Server Errors");
        }
    }

    /**
     */
    public function profile_update(Request $request){

        $rules = array(
            'name'       => 'required',
        );

        $user_id  = $request->get('uid');
        $name     = $request->get('name');
        $oldpassword = $request->get('oldpassword');
        $password = $request->get('password');

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('user.profile',$user_id)->with('error','You must input Name!');
        }
        try {
            \DB::beginTransaction();
            $user = \DB::table('users')->where('id',$user_id)->first();
            if($oldpassword != ''){
                $rules = array(
                    'password'       => 'required|between:3,32',
                    'passwordconfirm'   => 'required|same:password',
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return Redirect::route('user.profile',$user_id)->with('error','Failed password changing');
                }

                if(Hash::check($oldpassword, $user->password)){

                    \DB::table('users')->where('id',$user_id)->update([
                        'name' => $name,
                        'password'      => Hash::make($password),
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                }else{
                    return Redirect::route('user.profile',$user_id)->with('error','Incorrect old password');
                }

            }else{

                \DB::table('users')->where('id',$user_id)->update([
                    'name'  => $name,
                    'updated_at'=> date('Y-m-d H:i:s')
                ]);
            }

            \DB::commit();
            return Redirect::route('user.profile')->with('success', "Updated a user information successfully");

        }catch(\Exception $e){
            \DB::rollBack();
            return Redirect::route('user.profile',$user_id)->with('error', "Failed updating!");
        }
    }

    /////////////////////////////////////////

    /**
     * User management
     * list, create, store, update, profile, password reset, delete
     */

    public function user_list(Request $request){

        try {
            $users = \DB::table('users as u')
                ->join('role_users as ru', 'ru.user_id', '=', 'u.id')
                ->join('roles as r', 'r.id', '=', 'ru.role_id')
                ->join('activations as a', 'a.user_id', '=', 'u.id')
                ->select('u.*','a.completed','r.slug as role_slug','r.name as role_name')
                ->where('a.completed',1)
                ->get();
            \DB::commit();

            return View('user.index', compact('users'));

        }catch(\Exception $e){
            return Redirect::route('settings')->with('error','Users loading failed');
        }
    }

    public function create(){

        try {
            \DB::beginTransaction();

            $roles = DB::table('roles')->select('id','name')->get();
            \DB::commit();
            return view('user.create',compact('roles'));
        }catch(\Exception $e){
            \DB::rollBack();
            return back()->with('error', "Server Errors");
        }
    }

    /**
     * @param
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */

    public function edit($id){

        try {
            \DB::beginTransaction();
            $roles = DB::table('roles')->select('id','name')->get();
            $user = DB::table('users as u')
                ->join('role_users as ru', 'ru.user_id', '=', 'u.id')
                ->join('roles as r', 'r.id', '=', 'ru.role_id')
                ->join('activations as a', 'a.user_id', '=', 'u.id')
                ->select('u.*','r.slug','r.id as role_id')
                ->where('u.id',$id)
                ->first();

            \DB::commit();

            return view('user.edit',compact('user','roles'));
        }catch(\Exception $e){
            \DB::rollBack();
            \Log::info($e);
            return back()->with('error', "Server Errors");
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request){

        $rules = array(
            'email'        => 'required|unique:users',
            'password'      => 'required|between:3,32',
            'passwordconfirm' => 'required|same:password',
            'name'          => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('settings.user.add')->with('error','Please input all fields correctly');
        }

        try {
            \DB::beginTransaction();

            $rid = $request->get('rid');
            //$role = \DB::table('roles')->where('id',$request->get('rid'))->select('*')->first();

            $user = new User();
            $user->name         = $request->get('name');
            $user->password     = Hash::make($request->get('password'));
            $user->email        = $request->get('email');
            $user->save();

            //role_user Table
            \DB::table('role_users')->insert(['user_id'=>$user->id, 'role_id'=>$rid]);
            //Activations Table
            \DB::table('activations')->insert(['user_id'=>$user->id, 'completed'=>1]);
            \DB::commit();
            return Redirect::route('settings.user')->with('success', "Successful Added!");

        }catch(\Exception $e){
            \Log::info($e);
            \DB::rollBack();
            return Redirect::route('settings.user.add')->with('error', "Failed Adding");
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request){

        $rules = array(
            'name'       => 'required',
        );

        $user_id  = $request->get('uid');
        $role_id  = $request->get('rid');
        $name     = $request->get('name');
        $oldpassword = $request->get('oldpassword');
        $password = $request->get('password');

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::route('settings.user.edit',$user_id)->with('error','You must input Name!');
        }
        try {
            \DB::beginTransaction();
            $user = \DB::table('users')->where('id',$user_id)->first();
            if($oldpassword != ''){
                $rules = array(
                    'password'       => 'required|between:3,32',
                    'passwordconfirm'   => 'required|same:password',
                );

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return Redirect::route('settings.user.edit',$user_id)->with('error','Failed password changing');
                }

                if(Hash::check($oldpassword, $user->password)){

                    \DB::table('users')->where('id',$user_id)->update([
                        'name' => $name,
                        'password'      => Hash::make($password),
                        'updated_at'    => date('Y-m-d H:i:s')
                    ]);
                }else{
                    return Redirect::route('settings.user.edit',$user_id)->with('error','Incorrect old password');
                }

            }else{

                \DB::table('users')->where('id',$user_id)->update([
                    'name'  => $name,
                    'updated_at'=> date('Y-m-d H:i:s')
                ]);
            }

            //role_user Table
            \DB::table('role_users')->where('user_id',$user_id)->update([
                'role_id'=>$role_id
            ]);

            \DB::commit();
            return Redirect::route('settings.user')->with('success', "Updated a user information successfully");

        }catch(\Exception $e){
            \DB::rollBack();
            return Redirect::route('settings.user.edit',$user_id)->with('error', "Failed updating!");
        }
    }

    //deny admin
    public function delete(Request $request){
        $id = $request->get('uid');
        try {
            \DB::beginTransaction();
            \DB::table('activations')->where('user_id',$id)->update([
                'user_id' => 0
            ]);
            \DB::commit();
            return  Redirect::route('settings.user')->with('success', 'Deleted a User Successfully');
        }catch(\Exception $e){
            \Log::info($e);
            \DB::rollBack();
            return  Redirect::route('settings.user')->with('error', 'Failed deleting');
        }

//        if(\DB::table('users')->where('id',$id)->delete()){
//            //Role_users Table
//            \DB::table('role_users')->where('user_id',$id)->delete();
//            //Activations Table
//            \DB::table('activations')->where('user_id',$id)->delete();
//            return  Redirect::route('settings.user')->with('success', 'Deleted a User Successfully');
//        }
//        return  Redirect::route('settings.user')->with('error', 'Error!');
    }

    public function format(Request $request){
        $id = $request->get('uid');
        try {
            \DB::beginTransaction();
            $user = \DB::table('users')->where('id',$id)->first();
            \DB::table('users')->where('id',$id)->update([
                'password'      => Hash::make('admin'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);
            \DB::commit();
            return  Redirect::route('settings.user')->with('success', $user->name.' reset password as "admin"');
        }catch(\Exception $e){
            \Log::info($e);
            \DB::rollBack();
            return  Redirect::route('settings.user')->with('error', 'Failed reset password!');
        }
    }

}

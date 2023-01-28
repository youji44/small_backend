<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NewNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //register
    public function register(Request $request)
    {

        if($request->name == null)
        {
            return response()->json((['success'=>false,'message'=>'name field is required']));
        }
        if($request->email == null)
        {
            return response()->json((['success'=>false,'message'=>'email field is required']));
        }
        if($request->password == null)
        {
            return response()->json((['success'=>false,'message'=>'password field is required']));
        }
        $check = User::where('email','=',$request->email)->first();
        if($check)
        {
            return response()->json((['success'=>false,'message'=>'This email is already registerd']));
        }
        $input = $request->all();

        $input['password'] = bcrypt($input['password']);
        // $input['user_admin'] = $input['user_admin']
        $user = User::create($input);
        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        $success['id'] = $user->id;
        return response()->json(['success'=>true,'message'=>'register successfully']);
    }

    //login
    public function login(Request $request)
    {
        $email = $request->email == null;
        if($email)
        {
            return response()->json((['success'=>false,'message'=>'email field is required']));

        }
        $passwrod = $request->password == null;
        if($passwrod)
        {
            return response()->json((['success'=>false,'message'=>'password field is required']));

        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            $success['id'] =  $user->id;
            $success['name'] = $user->name;
            $success['email'] = $user->email;

            return response()->json(['success'=>true,'user'=>$success]);
        }
        else{
            return response()->json(['success'=>false,'message'=>'Unauthorized access']);
        }
    }

    //logout
    public function logout(Request $request)
    {
        if (Auth::guard('api')->check())
        {
            $request->user()->token()->revoke();
            return response()->json(['success'=>true,'message'=>'logout successfully']);
        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }
        $request->user()->token()->revoke();
        return response()->json(['success'=>true,'message'=>'logout successfully']);
    }

    //loginCheck
    public function loginCheck()
    {
         if (Auth::guard('api')->check())
    {
        logger(Auth::guard('api')->user()); // to get user
        return response()->json(['success'=>true,'message'=>'user is login']);

    }else{
        return response()->json(['success'=>false,'message'=>'user is not login']);
    }
    }

    //getNotification
    public function getNotification()
    {
        if (Auth::guard('api')->check())
        {
            $user = User::find(1);
           if($user->notifications == null)
           {
            return response()->json(['success'=>true,'notification'=>'No new notificaion']);
           }else{
            return response()->json(['success'=>true,'notification'=>$user->notifications]);
           }

        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }
    }

    //unreadNotification
    public function unreadNotification()
    {
        if (Auth::guard('api')->check())
        {
            $user = User::find(1);
            $user_id = $user->id;
            $count = NewNotification::where([['user_id','=',$user_id],['status','=',1]])->count();

            return response()->json(['success'=>true,'unreadNotificaitonCount'=>$count]);


        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }
    }

    //ViewNotification
    public function ViewNotification()
    {
        if (Auth::guard('api')->check())
        {
            DB::select("UPDATE `new_notifications` SET `status`='0'");
            $user = User::find(1);
            $user_id = $user->id;
            $count = NewNotification::where('user_id','=',$user_id)->get();
            return response()->json(['success'=>true,'notification'=>$count]);


        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }
    }

    //deleteNotification
    public function deleteNotification($id)
     {
        if (Auth::guard('api')->check())
        {
            $data = NewNotification::find($id);
            if($data == null)
            {
                return response()->json((['success'=>false,'message'=>'no record found']));
            }else{
            $data->delete();
            return response()->json(['success'=>true,'message'=>'Notification deleted successfully']);
            }
        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }

     }



}

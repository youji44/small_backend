<?php

namespace App\Http\Controllers;

use App\Models\NewNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
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

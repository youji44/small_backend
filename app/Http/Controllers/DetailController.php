<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Events\StoreUserDetail;
use App\Events\UpdateStatusEvent;
use App\Models\NewNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserDetialNotification;


class DetailController extends Controller
{
    //StoreDetail
    public function StoreDetail(Request $request)
    {
        if($request->browsersDetails == null)
            {
                return response()->json(['success'=>false,'message'=>'Browsers Details is required']);
            }
            if($request->name == null)
            {
                return response()->json(['success'=>false,'message'=>'Name is required']);
            }
            if($request->dateTime == null)
            {
                return response()->json(['success'=>false,'message'=>'Date Time is required']);
            }
            $ip = $request->ip();
            $ips=$_SERVER['REMOTE_ADDR'];
            $ipinfo = file_get_contents("https://ipinfo.io/" . $ips);
            $ipinfo_json = json_decode($ipinfo, true);
            if($ipinfo_json['org']== null)
            {
              $ispDetail = null;
            }
            else
            {
                $ispDetail=$ipinfo_json['org'];
            }

           $details = new UserDetail();
           $details->browsersDetails = $request->browsersDetails;
           $details->name = $request->name;
           $details->dateTime = $request->dateTime;
           $details->ipAddress =  $ip;
           $details->isp = $ispDetail;
           $details->enable = 1;
           $details->save();
           $detail_id = UserDetail::max('id');
           $detail = [
            'det_id'=>$detail_id,
            'browsersDetails'=>$request->browsersDetails,
            'name'=>$request->name,
            'dateTime'=>$request->dateTime,
            'ipAddress'=> $ip,
            'isp'=>$ispDetail,
           ];
        //    return json_encode($data);
           if($details)
           {
            $user = User::find(1);
            Notification::send($user, new UserDetialNotification($detail));
            $notification = new NewNotification();
            $notification->user_id = $user->id;
            $notification->notification = json_encode($detail);
            $notification->status = 1;
            $notification->save();
            event(new StoreUserDetail($request->name));
            return response()->json(['success'=>true,'message'=>'User Details Stored successfully']);
           }else{
            return response()->json(['success'=>false,'message'=>'Someting went worng please try again']);
           }

    }

    //ViewAllUserDetails
    public function ViewAllUserDetails()
    {
        if (Auth::guard('api')->check())
        {
          $data = UserDetail::all();
          return response()->json(['success'=>true,'userDetails'=>$data]);
        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }
    }

    //updateStatus
    public function updateStatus(Request $request)
    {
        if (Auth::guard('api')->check())
        {
            if($request->id == null)
            {
                return response()->json(['success'=>false,'message'=>'id is required']);
            }
            if($request->enable == false)
            {
                return response()->json(['success'=>false,'message'=>'id is required']);
            }
          $data = UserDetail::find($request->id);
          $data->enable = $request->enable;
          $data->save();
          event(new UpdateStatusEvent($data));
          return response()->json(['success'=>true,'message'=>'record updated successfully']);
        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }
    }


    //deleteUserDetail
    public function deleteUserDetail($id)
    {
        if (Auth::guard('api')->check())
        {
          $data = UserDetail::find($id);
            if($data == null)
            {
                return response()->json(['success'=>false,'message'=>'no record found']);
            }else{
                $data->delete();
            }
          return response()->json(['success'=>true,'message'=>'record deleted successfully']);
        }else{
            return response()->json([ "success"=>false,"error" => "Not Authorized" ], 401);
        }
    }

    //CheckApi
    public function CheckApi(Request $request)
    {
        $ip = $request->ip();
        $check = UserDetail::where('ipAddress','=',$ip)->first();
        if($check)
        {
            return response()->json(['success'=>true,'details'=>$check]);
        }else{
            return response()->json(['success'=>false,'message'=>'no record found']);
        }

    }

    //viewForm
    public function viewForm()
    {
        return view('form');
    }



}

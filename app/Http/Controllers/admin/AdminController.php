<?php

namespace App\Http\Controllers\admin;


use App\Events\UpdateStatusEvent;
use App\Models\NewNotification;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\VisitorDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $data = \DB::table('user_details')->orderby('dateTime','DESC')->get();
        return view('admin.dashboard',compact('data'));
    }

    public function update_detail(Request $request)
    {
        try{
            $data = UserDetail::find($request->id);
            $data->enable = $request->enable;
            $data->save();
            //event(new UpdateStatusEvent($data));
        }catch (\Exception $e){
            \Log::info($e);
        }
        return Redirect::route('dashboard')->with('success', 'Success updated');
    }

    public function delete_detail($id)
    {
        if(UserDetail::find($id)->delete())
            return Redirect::route('dashboard')->with('success', 'Success delete');
        else
            return Redirect::route('dashboard')->with('error', 'Failed delete');
    }

    public function check(Request $request){

        try{
            $visit_count = $request->get('visit',0);
            $store_count = $request->get('store',0);

            $visit = VisitorDetail::all();
            $visit_total = $visit?$visit->count():0;

            $store = NewNotification::all();
            $store_total = $store?$store->count():0;

            if($visit_count == 0 || $store_count == 0){
                $is_visit = false;
                $is_store = false;

            }else if($visit_count < $visit_total && $store_count < $store_total){
                $is_visit = true;
                $is_store = true;
            } else if ($visit_count >= $visit_total && $store_count < $store_total){
                $is_visit = false;
                $is_store = true;
            } else if ($visit_count < $visit_total && $store_count >= $store_total){
                $is_visit = true;
                $is_store = false;
            } else{
                $is_visit = false;
                $is_store = false;
            }
            return response()->json([
                'visitor' => $is_visit,
                'visit_count'=>$visit_total,
                'store'=>$is_store,
                'store_count'=>$store_total]);

        }catch (\Exception $e){
            \Log::info($e);
            return response()->json([
                'visitor' => false,
                'visit_count'=>$visit_total,
                'store'=>false,
                'store_count'=>$store_total]);
        }
    }
}

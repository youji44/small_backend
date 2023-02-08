<?php

namespace App\Http\Controllers\admin;


use App\Events\UpdateStatusEvent;
use App\Models\User;
use App\Models\UserDetail;
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
}

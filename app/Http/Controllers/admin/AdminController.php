<?php

namespace App\Http\Controllers\admin;


use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $data = UserDetail::all();
        return view('admin.dashboard',compact('data'));
    }

    public function update_detail(Request $request)
    {
        $data = UserDetail::find($request->id);
        $data->enable = $request->enable;
        $data->save();
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

<?php

namespace App\Http\Controllers;

use App\Models\AccessModel;
use App\Models\AccessPoint;
use App\Models\Permissions;
use App\Models\User;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index($id)
    {
        //get user role permission array
        $permission = Permissions::where('user_id', $id)->first();
        // get user role by id
        $user = User::find($id);
        //get Access models
        $access_model = AccessModel::all();
        //get all access point
        $access_point = AccessPoint::all();
        return view('layouts.auth.permission')
            ->with('access_model', $access_model)
            ->with('user', $user)
            ->with('permission', $permission)
            ->with('access_point', $access_point);
    }

    public function store(Request $request)
    {
        $prives = $request->input('checkboxvar');

        // $a = app('App\Http\Controllers\ActivityLogController')->index("Permission Added");

        $pid = $request->input('permission_id');
        if ($pid == 0) { // create


            $permission = new Permissions();
        } else { // update

            $permission = Permissions::find($pid);
        }

        try {

            $a = false;

            $permission->permision = json_encode($prives);
            $permission->user_id = $request->input('user');


            $permission->save();

            return redirect()->route('user.index')->with('success', 'Permission Added Sucessfully');
        } catch (\Throwable $th) {
            return redirect()->route('user.index')->with('error', 'Permission Added Failed');
        }
    }
}

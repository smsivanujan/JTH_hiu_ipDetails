<?php

namespace App\Http\Controllers;

use App\Models\AccessModel;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class AccessModelController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $access_model = AccessModel::all();
        return view('layouts.auth.accessModal')->with('model_list', $access_model);
    }

    public function store(Request $request)
    {
        // $a = false; //activity status

        // $a = app('App\Http\Controllers\ActivityLogController')->index("Create Access Model");

        $id = $request->id;
 
        if ($id == 0) { // create
           
            $this->validate($request, [
                'name' => 'unique:acess_models,name',
            ]);

            $acessModel = new AccessModel();

        } else { // update
            $this->validate($request, [
                'name' => 'unique:acess_models,name,' .$id,
            ]);

            $acessModel = AccessModel::find($id);
        }
        
        try {
            $acessModel->name = $request->input('name');
            $acessModel->save();
            
            return redirect()->route('access_model.index')->with('success', 'Accsess Model Added Sucessfully');

        } catch (\Throwable $th) {        
            return redirect()->route('access_model.index')->with('error', 'Accsess Model Failed Sucessfully');  
        }
    }

    public function destroy(Request $request)
    {
        //
        // $a = false;
        // $data = acessModel::find($request->input('delete_id'));
        // $data->delete();
        // $a = app('App\Http\Controllers\ActivityLogController')->index("Remove Access Model");

        // if ($a == true) {
        //     return redirect()->route('access_model.index')->with('msg', 'Record has been removed!!!');
        // } else {
        //     return "Error";
        // }
    }
}

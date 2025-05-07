<?php

namespace App\Http\Controllers;

use App\Models\SurgeryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class SurgeryTypeController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $surgeryTypes = DB::table('surgery_types')
            ->select('id', 'surgery_name', 'detail')
            ->orderByDesc('surgery_types.id')
            ->get();

        return view('pages.surgeryType', compact('surgeryTypes'));
    }

    public function save(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'surgery_name' => 'unique:surgery_types,surgery_name'
            ]);
            $surgery = new SurgeryType();

        } else { // update

            $this->validate($request, [
                'surgery_name' => 'unique:surgery_types,surgery_name,' .$id
            ]);
            $surgery = SurgeryType::find($id);
        }

        $surgery->surgery_name = $request->input('surgery_name');
        $surgery->Detail = $request->input('Detail');
        $surgery->save();

        return redirect()->route('surgeryType.index')->with('success', 'Surgery type data saved successfully.');
    }
}

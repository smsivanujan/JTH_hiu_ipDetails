<?php

namespace App\Http\Controllers;

use App\Models\CardioThoraric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CardioThoraricController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $cardios = DB::table('cardio_thoraric')
            ->select(
                'cardio_thoraric.id',
                'cardio_thoraric.ctu_number',
                'surgery_types.id AS surgery_id',
                'surgery_types.surgery_name',
                'cardio_thoraric.prefix',
                'cardio_thoraric.full_name',
                'cardio_thoraric.gender',
                'cardio_thoraric.age',
                'cardio_thoraric.contact_number_1',
                'cardio_thoraric.contact_number_2',
                'cardio_thoraric.district',
                'cardio_thoraric.address',
                'cardio_thoraric.ef',
                'cardio_thoraric.diagnosis',
                'cardio_thoraric.comments',
                'cardio_thoraric.cts',
                'cardio_thoraric.status'
            )
            ->join('surgery_types', 'cardio_thoraric.surgery_id', 'surgery_types.id')
            ->orderBy('cardio_thoraric.id', 'desc')
            ->get();

        $priority_surgeries = ['CABG', 'MVR', 'AVR', 'ASD Closure', 'PAPVD Repair', 'Atrial Myxoma Excision'];
        $surgeries = DB::table('surgery_types')
            ->select('id', 'surgery_name')
            ->orderByRaw('FIELD(surgery_name, ' . implode(', ', array_map(function ($surgery) {
                return "'" . $surgery . "'";
            }, $priority_surgeries)) . ') DESC')
            ->orderBy('surgery_name')
            ->get();

        return view('pages.cardio', compact('surgeries', 'cardios'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search-term');

        $patients = DB::table('jthhims.patientdemographic')
            ->select(
                'jthhims.patientdemographic.patientID',
                'jthhims.patientdemographic.patientPersonalTitle',
                'jthhims.patientdemographic.patientName',
                DB::raw("CONCAT(UPPER(LEFT(jthhims.patientdemographic.patientSex, 1)), LOWER(SUBSTRING(jthhims.patientdemographic.patientSex, 2))) AS patientSex"),
                'jthhims.patientdemographic.patientDateofbirth',
                'jthhims.department.departmentTitle AS ward',
                'jthhims.admission.BHTClinicFileNo'
            )
            ->join('jthhims.admission', 'jthhims.patientdemographic.patientID', '=', 'jthhims.admission.patientID')
            ->join('jthhims.department', 'jthhims.admission.departmentCode', '=', 'jthhims.department.departmentCode')
            ->where('jthhims.admission.BHTClinicFileNo', function ($query) use ($searchTerm) {
                $query->select('jthhims.admission.BHTClinicFileNo')
                    ->from('jthhims.admission')
                    ->where('jthhims.admission.patientID', DB::raw('jthhims.patientdemographic.patientID'))
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('jthhims.patientdemographic.patientID', $searchTerm)
                            ->orWhere('jthhims.patientdemographic.patientNIC', $searchTerm)
                            ->orWhere('jthhims.patientdemographic.patientContactLand01', $searchTerm)
                            ->orWhere('jthhims.patientdemographic.patientContactLand02', $searchTerm)
                            ->orWhere('jthhims.patientdemographic.patientContactMobile01', $searchTerm)
                            ->orWhere('jthhims.patientdemographic.patientContactMobile02', $searchTerm)
                            ->orWhere('jthhims.admission.BHTClinicFileNo', $searchTerm);
                    })
                    ->orderBy('jthhims.admission.insertedOn', 'desc')
                    ->limit(1);
            })
            ->get();


        if ($patients->isEmpty()) {
            return response()->json(['message' => 'No data found'], 404);
        }

        return response()->json($patients->first());
        // $searchTerm = $request->input('search-term');

        // $patients = DB::table('PatientDemographic')
        //     ->where('patientID', $searchTerm)
        //     ->orWhere('patientNIC', $searchTerm)
        //     ->orWhere('patientPassport', $searchTerm)
        //     ->orWhere('motherBHT', $searchTerm)
        //     ->orWhere('patientContactLand01', $searchTerm)
        //     ->orWhere('patientContactLand02', $searchTerm)
        //     ->orWhere('patientContactMobile01', $searchTerm)
        //     ->orWhere('patientContactMobile02', $searchTerm)
        //     ->get();

        // if ($patients->isEmpty()) {
        //     return response()->json(['message' => 'No data found'], 404);
        // }

        // return response()->json($patients->first());
    }

    public function save(Request $request)
    {
        $id = $request->id;

        if ($id == 0) { // create

            $this->validate($request, [
                'ctu_number' => 'unique:cardio_thoraric,ctu_number'
            ]);
            $surgery = new CardioThoraric();
        } else { // update
            $this->validate($request, [
                'ctu_number' => 'unique:cardio_thoraric,ctu_number,' . $id
            ]);
            $surgery = CardioThoraric::find($id);
        }

        $surgery->ctu_number = $request->input('ctu_number');
        $surgery->surgery_id = $request->input('surgery');
        $surgery->prefix = $request->input('prefix');
        $surgery->full_name = $request->input('full_name');
        $surgery->gender = $request->input('gender');
        $surgery->age = $request->input('age');
        $surgery->contact_number_1 = $request->input('contact_number_1');
        $surgery->contact_number_2 = $request->input('contact_number_2');
        $surgery->district = $request->input('district');
        $surgery->address = $request->input('address');
        $surgery->ef = $request->input('ef');
        $surgery->diagnosis = $request->input('diagnosis');
        $surgery->comments = $request->input('comments');
        $surgery->cts = $request->input('cts');
        $surgery->status = $request->input('status');
        $surgery->save();

        return redirect()->route('cardio.index')->with('success', 'Cardiothoracic patient saved successfully.');
    }
}

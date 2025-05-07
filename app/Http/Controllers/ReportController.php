<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function cardioByStatus(Request $request)
    {
        $status = $request->status;
        $surgeryType = $request->surgery;

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
            ->join('surgery_types', 'cardio_thoraric.surgery_id', '=', 'surgery_types.id');

        if ($status && $surgeryType) {
            $cardios = $cardios->where('cardio_thoraric.status', '=', $status)
                ->where('surgery_types.id', '=', $surgeryType);
        }
        elseif ($status) {
            $cardios = $cardios->where('cardio_thoraric.status', '=', $status);
        }
        elseif ($surgeryType) {
            $cardios = $cardios->where('surgery_types.id', '=', $surgeryType);
        }
        else {
            // $cardios = collect();
        }
        $cardios = $cardios->get();


        $surgeries = DB::table('surgery_types')
            ->select('id', 'surgery_name', 'detail')
            ->orderByDesc('surgery_types.id')
            ->get();

        return view('reports.cardioStatusReport', compact('cardios', 'surgeries', 'surgeryType', 'status'));
    }
}

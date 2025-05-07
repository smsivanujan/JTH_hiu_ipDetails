<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $total_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalPatient FROM  cardio_thoraric");

        $total_sucessfull_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalSucessfullPatient FROM  cardio_thoraric 
        WHERE status = 'Surgery Done' ");

        $total_waiting_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalWaitingPatient FROM  cardio_thoraric
        WHERE status = 'Awaiting' ");

        $total_passedAway_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalPassedawayPatient FROM  cardio_thoraric
        WHERE status = 'Passed Away' ");

        $total_medicalmanagement_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalMedicalmanagementPatient FROM  cardio_thoraric
        WHERE status = 'Medical Management' ");

        $total_notintrest_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalNotintrestPatient FROM  cardio_thoraric
        WHERE status = 'Not Intrest' ");

        $total_notfit_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalNotfitPatient FROM  cardio_thoraric
        WHERE status = 'Not Fit' ");

        $total_unabletocontact_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalUnabletocontactPatient FROM  cardio_thoraric
        WHERE status = 'Unable To Contact' ");

        $total_patientdecisionpending_patients = DB::select("SELECT IFNULL(COUNT(id),0) AS totalPatientdecisionpendingPatient FROM  cardio_thoraric
        WHERE status = 'Patient Decision Pending' ");

        // $total_other_patients = DB::select("SELECT IFNULL(COUNT(id), 0) AS totalOtherPatient FROM cardio_thoraric 
        // WHERE status NOT IN ('Surgery Done', 'Awaiting')");

        $pie_charts = DB::select("SELECT status, IFNULL(COUNT(id), 0) AS totalPatients FROM cardio_thoraric 
        GROUP BY status");

        return view('pages.index')
            ->with('total_patients', $total_patients)
            ->with('total_sucessfull_patients', $total_sucessfull_patients)
            ->with('total_waiting_patients', $total_waiting_patients)
            ->with('total_passedAway_patients', $total_passedAway_patients)
            ->with('total_medicalmanagement_patients', $total_medicalmanagement_patients)
            ->with('total_notintrest_patients', $total_notintrest_patients)
            ->with('total_notfit_patients', $total_notfit_patients)
            ->with('total_unabletocontact_patients', $total_unabletocontact_patients)
            ->with('total_patientdecisionpending_patients', $total_patientdecisionpending_patients)
            ->with('pie_charts', $pie_charts);
    }
}

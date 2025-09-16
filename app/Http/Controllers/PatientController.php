<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function showPatientInfo(Patient $patient)
    {
        return view('profile', compact('patient'));
    }




    public function search(Request $request)
    {
        $query = $request->input('query');

        $patients = Patient::where('first_name', 'like', "%{$query}%")
            ->orWhere('middle_name', 'like', "%{$query}%")
            ->orWhere('last_name', 'like', "%{$query}%")
            ->orWhere('contact', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->orderBy('last_name')
            ->paginate(5)
            ->withQueryString();

        if ($request->ajax()) {
            return view('components.patient-partials', compact('patients'));
        }

        return view('patient-record', compact('patients'));
    }


    public function destroyPatient(Patient $patient)
    {
        $patient->delete();

        return redirect()->back()->with('success', 'Patient deleted successfully.');
    }

    public function showPatientRecordPage()
    {
        $patients = Patient::orderBy('created_at', 'desc')->paginate(5);

        return view('patient-record', compact('patients'));
    }
}

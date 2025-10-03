<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medicine;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function updatePatientInfo(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female',
            'birthdate' => 'required|date',
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $patient->update($validated);

        return redirect()
            ->route('patientInfo', $patient)
            ->with('success', 'Patient info updated successfully.');
    }


    public function createPatient(Request $request)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:100',
            'middle_name'  => 'nullable|string|max:100',
            'last_name'    => 'required|string|max:100',
            'gender'       => 'required|string',
            'birthdate'    => 'required|date',
            'address'      => 'required|string|max:255',
            'contact'      => 'required|string|max:20',
        ]);


        $exists = Patient::where('first_name', $request->first_name)
            ->where('last_name', $request->last_name)
            ->where('birthdate', $request->birthdate)
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->withErrors(['patient_exists' => 'Patient already exists in the records.'])
                ->withInput();
        }


        Patient::create($validated);

        return redirect()->route('patientRecord')->with('success', 'Patient added successfully.');
    }



    public function showPatientInfo(Patient $patient)
    {
        $patient->load([
            'consultations.prescriptions.medicine'
        ]);

        $medicines = Medicine::all();

        return view('profile', compact('patient', 'medicines'));
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

<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Medicine;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    public function store(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'diagnosis' => 'required|string',
            'notes' => 'nullable|string',
            'medicines' => 'nullable|array',
            'medicines.*.id' => 'required|exists:medicines,id',
            'medicines.*.quantity' => 'required|integer|min:1',
        ]);


        $consultation = Consultation::create([
            'patient_id' => $patient->patient_id,
            'date' => $validated['date'],
            'diagnosis' => $validated['diagnosis'],
            'notes' => $validated['notes'] ?? null,
        ]);


        if (!empty($validated['medicines'])) {
            foreach ($validated['medicines'] as $medicineData) {
                $medicine = Medicine::findOrFail($medicineData['id']);


                if ($medicine->quantity < $medicineData['quantity']) {
                    return redirect()->back()->withErrors([
                        'medicines' => "Not enough stock for {$medicine->name}. Available: {$medicine->quantity}"
                    ]);
                }


                Prescription::create([
                    'consultation_id' => $consultation->id,
                    'medicine_id' => $medicine->id,
                    'quantity' => $medicineData['quantity'],
                ]);


                $medicine->decrement('quantity', $medicineData['quantity']);
            }
        }

        return redirect()->route('patientInfo', $patient)
            ->with('success', 'Consultation saved!');
    }
}

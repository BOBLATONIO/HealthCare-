<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Prescription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Consultation;

class DashboardController extends Controller
{
    public function showDashboardPage()
    {
        $patients = Patient::all();
        $medicines = Medicine::where('quantity', '<=', 50)->get();

        // PostgreSQL-compatible day of week query
        // Note: PostgreSQL EXTRACT(DOW FROM date) returns 0-6 where 0=Sunday, 1=Monday, etc.
        // We adjust it to match your original mapping where 2=Monday
        $dailyCheckups = Consultation::select(
            DB::raw("CASE 
                        WHEN EXTRACT(DOW FROM date) = 1 THEN 2  -- Monday
                        WHEN EXTRACT(DOW FROM date) = 2 THEN 3  -- Tuesday
                        WHEN EXTRACT(DOW FROM date) = 3 THEN 4  -- Wednesday
                        WHEN EXTRACT(DOW FROM date) = 4 THEN 5  -- Thursday
                        WHEN EXTRACT(DOW FROM date) = 5 THEN 6  -- Friday
                        WHEN EXTRACT(DOW FROM date) = 6 THEN 7  -- Saturday
                        WHEN EXTRACT(DOW FROM date) = 0 THEN 1  -- Sunday (not used in your data)
                     END as day"),
            DB::raw('COUNT(*) as total')
        )
            ->whereBetween('date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->groupBy(DB::raw("CASE 
                              WHEN EXTRACT(DOW FROM date) = 1 THEN 2
                              WHEN EXTRACT(DOW FROM date) = 2 THEN 3
                              WHEN EXTRACT(DOW FROM date) = 3 THEN 4
                              WHEN EXTRACT(DOW FROM date) = 4 THEN 5
                              WHEN EXTRACT(DOW FROM date) = 5 THEN 6
                              WHEN EXTRACT(DOW FROM date) = 6 THEN 7
                              WHEN EXTRACT(DOW FROM date) = 0 THEN 1
                           END"))
            ->pluck('total', 'day');

        // Map the results to your day format (Monday starts at 2 in your original code)
        $checkupData = [
            'Mon' => $dailyCheckups[2] ?? 0,
            'Tue' => $dailyCheckups[3] ?? 0,
            'Wed' => $dailyCheckups[4] ?? 0,
            'Thu' => $dailyCheckups[5] ?? 0,
            'Fri' => $dailyCheckups[6] ?? 0,
            'Sat' => $dailyCheckups[7] ?? 0,
        ];

        // Top medicines query (unchanged, works with PostgreSQL)
        $topMedicines = Prescription::select('medicine_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('medicine_id')
            ->orderByDesc('total')
            ->with('medicine')
            ->take(5)
            ->get();

        $medicineNames = $topMedicines->pluck('medicine.name')->toArray();
        $medicineTotals = $topMedicines->pluck('total')->toArray();

        return view('dashboard', compact(
            'patients',
            'medicines',
            'checkupData',
            'medicineNames',
            'medicineTotals'
        ));
    }
}

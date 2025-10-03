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

        $dailyCheckups = Consultation::selectRaw('DAYOFWEEK(`date`) as day, COUNT(*) as total')
            ->whereBetween('date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->groupBy('day')
            ->pluck('total', 'day');

        $checkupData = [
            'Mon' => $dailyCheckups[2] ?? 0,
            'Tue' => $dailyCheckups[3] ?? 0,
            'Wed' => $dailyCheckups[4] ?? 0,
            'Thu' => $dailyCheckups[5] ?? 0,
            'Fri' => $dailyCheckups[6] ?? 0,
            'Sat' => $dailyCheckups[7] ?? 0,
        ];


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

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['medicine_id', 'name', 'quantity'];

    // Auto-generate medicine_id when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($medicine) {
            $yearMonth = Carbon::now()->format('Ym'); // YYYYMM
            $lastMedicine = self::where('medicine_id', 'like', 'M' . $yearMonth . '%')
                ->orderBy('medicine_id', 'desc')
                ->first();

            if ($lastMedicine) {
                $lastNumber = intval(substr($lastMedicine->medicine_id, 7)); // get last 3 digits
                $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = '001';
            }

            $medicine->medicine_id = 'M' . $yearMonth . $newNumber;
        });
    }
}

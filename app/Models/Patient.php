<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public $incrementing = false; // because primary key is string
    protected $keyType = 'string';
    protected $primaryKey = 'patient_id'; // set custom primary key

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'contact',
        'address',
        'birthdate'
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class, 'patient_id');
    }


    // Auto-generate patient_id when creating a new patient
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($patient) {
            $last = self::orderBy('patient_id', 'desc')->first();

            if ($last) {
                $number = (int) substr($last->patient_id, 3) + 1;
            } else {
                $number = 1;
            }

            $patient->patient_id = 'RCP' . str_pad($number, 4, '0', STR_PAD_LEFT);
        });
    }
}

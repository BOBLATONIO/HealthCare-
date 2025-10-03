<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'patient_id',
        'date',
        'diagnosis',
        'notes',
    ];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }




    public function prescriptions()
    {
        return $this->hasMany(Prescription::class, 'consultation_id');
    }
}

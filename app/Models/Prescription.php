<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'consultation_id',
        'medicine_id',
        'quantity',
    ];

    // A prescription belongs to one consultation
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }
}

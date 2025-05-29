<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'clinical_record_id',
        'medication_id',
        'dosage',
        'duration',
        'notes',
    ];

    public function clinicalRecord()
    {
        return $this->belongsTo(ClinicalRecord::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'pet_id',
        'vet_id',
        'date',
        'weight',
        'temperature',
        'symptoms',
        'diagnosis',
        'treatment',
        'notes',
    ];

    protected $dates = ['date'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}

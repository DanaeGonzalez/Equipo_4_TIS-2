<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'pet_name',
        'species',
        'breed',
        'color',
        'sex',
        'status',
        'date_of_birth',
        'microchip_number',
        'notes',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /* Descomentar cuando esten los modelos
    public function clinicalRecords()
    {
        return $this->hasMany(ClinicalRecord::class);
    }

    public function vaccinations()
    {
        return $this->hasMany(PetVaccination::class);
    }

    public function surgeries()
    {
        return $this->hasMany(Surgery::class);
    }

    public function allergies()
    {
        return $this->hasMany(Allergy::class);
    }*/
}

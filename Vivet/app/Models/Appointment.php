<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'pet_id',
        'vet_id',
        'service_id',
        'appointment_date',
        'reason',
        'status',
    ];

    protected $dates = ['appointment_date'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relaciones (opcional, pero recomendado)
    public function pet()
    {
        return $this->belongsTo(Pet::class,'pet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'vet_id' );
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

   

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;

use Carbon\Carbon;


class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [ //guardamos estos campos
        'user_id',
        'event_date',
        'event_time',
        'event_type',
        'is_reserved'
    ];

    public function user()
    { //permite acceder a los datos del usuario que creó el horario
        return $this->belongsTo(User::class);
    }
    // App\Models\Schedule.php
    public function appointment()
    {
        return $this->hasOne(Appointment::class, 'schedule_id');
    }



}


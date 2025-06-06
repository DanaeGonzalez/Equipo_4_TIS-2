<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'estimated_duration',
        'price',
        'icon',
        'is_active',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}

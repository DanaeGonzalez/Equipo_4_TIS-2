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
        return $this->belongsTo(Client::class, 'client_id');
    }


}

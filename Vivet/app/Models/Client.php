<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'lastname',
        'client_run',
        'email',
        'phone',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function billings()
    {
        return $this->hasMany(Billing::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Clinic extends Model
{
    use HasDatabase, HasDomains;

    protected $table = 'clinics'; // 👈 Esto es clave

    protected $fillable = [
        'name',
        'subdomain',
        'domain',
        'email',
    ];
}

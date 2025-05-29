<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $hidden = [
        //'id',
        //'role_id',
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'run',
        'sex',
        'role_id',
        'is_active',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasPermission($permissionName)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permissionName)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionForRoute($route)
    {
        return $this->permissions->pluck('route')->contains($route);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function client()
    {
        return $this->hasOne(Client::class, 'user_id', 'id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'vet_id');
    }

    /*public function canAccessPanel(Panel $panel): bool
    {
        \Log::info('Verificando acceso al panel', [
            'user' => $this->email,
            'panel' => $panel->getId(),
        ]);

        return true; // o usar alguna lógica como email o rol (Implementar sprint 3)
    }*/

    public function canAccessPanel(Panel $panel): bool
    {
        // SUPERADMIN: acceso al panel central
        if ($panel->getId() === 'admin') {
            return $this->email === 'dgonzalezv@ing.ucsc.cl'; // 👈 pon tu correo real aquí
        }

        // TENANT: acceso al panel de clínicas (si aplica)
        if ($panel->getId() === 'tenant') {
            return true; // o algún control por rol, por ejemplo:
            // return $this->hasRole('admin');
        }

        return false;
    }

    /* Descomentar a medida que vayan haciendo los modelos
    public function clinicalRecords()
    {
        return $this->hasMany(ClinicalRecord::class, 'vet_id');
    }

    public function petVaccinations()
    {
        return $this->hasMany(PetVaccination::class, 'vet_id');
    }

    public function surgeries()
    {
        return $this->hasMany(Surgery::class, 'vet_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }*/
    public function exams()
    {
        return $this->hasMany(Exam::class, 'id');
    }
    
    public function examsSent()
    {
        return $this->hasMany(Exam::class, 'sender_id');
    }

    public function examsReceived()
    {
        return $this->hasMany(Exam::class, 'recipient_id');
    }
}

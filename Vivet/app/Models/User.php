<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
}

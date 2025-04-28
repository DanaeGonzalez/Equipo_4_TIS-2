<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'role_id';
    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'role_id');  // Relación de uno a muchos
    }


}

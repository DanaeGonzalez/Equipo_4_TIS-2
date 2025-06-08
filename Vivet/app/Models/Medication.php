<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'dosage_instructions',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

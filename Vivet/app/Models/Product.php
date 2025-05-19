<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'is_active'
    ];

    public function billingProducts()
    {
        return $this->hasMany(BillingProducts::class);
    }

    /*public function vaccines()
    {
        return $this->hasMany(Vaccine::class);
    }*/
}

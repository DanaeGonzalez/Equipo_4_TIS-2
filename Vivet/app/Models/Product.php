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
        'is_active',
        'is_vaccine'
    ];

    public function billingProducts()
    {
        return $this->hasMany(BillingProducts::class);
    }

    public function vaccine()
    {
        return $this->hasOne(Vaccine::class);
    }
}

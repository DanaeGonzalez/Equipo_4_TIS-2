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
        'category',
        'price',
        'stock',
        'is_active',
    ];

    public function billingProducts()
    {
        return $this->hasMany(BillingProducts::class);
    }

    public function vaccine()
    {
        return $this->hasOne(Vaccine::class);
    }

    public function medication()
    {
        return $this->hasOne(Medication::class);
    }
}

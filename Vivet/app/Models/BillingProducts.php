<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingProducts extends Model
{
    use HasFactory;
    protected $fillable = [
        'billing_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
    ];


    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

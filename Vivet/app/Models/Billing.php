<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
    protected $table = 'billing';

    protected $fillable = [
        'client_id',
        'sale_type',
        'appointment_id',
        'total_amount',
        'payment_method',
        'payment_date',
        'status',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function billingProducts()
    {
        return $this->hasMany(BillingProducts::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'billing_products')
            ->withPivot('quantity', 'unit_price', 'total_price');
    }
}

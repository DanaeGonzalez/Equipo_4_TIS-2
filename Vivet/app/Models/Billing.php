<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;
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

    // Relación con el cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relación con la cita (appointment)
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    // Relación con productos facturados
    public function billingProducts()
    {
        return $this->hasMany(BillingProducts::class);
    }
}


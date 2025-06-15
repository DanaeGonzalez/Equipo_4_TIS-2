<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'inventory_movement_id',
        'supplier_id',
        'quantity',
        'unit_cost',
        'total_cost',
        'purchase_date',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function inventoryMovement()
    {
        return $this->belongsTo(InventoryMovement::class);
    }
}

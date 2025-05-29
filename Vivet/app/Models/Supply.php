<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'stock',
        'unit_type',
        'units_per_box',
        'is_active'
    ];

    public function inventoryMovements()
    {
        return $this->morphMany(InventoryMovement::class, 'item');
    }
}

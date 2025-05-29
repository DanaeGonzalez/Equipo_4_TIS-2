<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_type',
        'item_id',
        'movement_type',
        'quantity',
        'reason',
        'user_id',
    ];

    public function item()
    {
        //Si el tipo de item es un producto, entonces tiene una relación de uno a uno con el producto
        if ($this->item_type === 'producto') {
            return $this->belongsTo(Product::class, 'item_id');
        }
        //Si el tipo de item es un insumo, entonces tiene una relacióbn de uno a uno con el insumo
        return $this->belongsTo(Supply::class, 'item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact_name',
        'phone',
        'email',
        'address',
    ];

    public function purchaseDetails()
    {
        return $this->hasMany(PurchaseDetail::class);
    }
    public function item()
    {
        //Si el tipo de item es un producto, entonces tiene una relación de uno a uno con el producto
        if ($this->item_type === 'producto') {
            return $this->belongsTo(Product::class, 'item_id');
        }
        //Si el tipo de item es un insumo, entonces tiene una relación de uno a uno con el insumo
        return $this->belongsTo(Supply::class, 'item_id');
    }
}

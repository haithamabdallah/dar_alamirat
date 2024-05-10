<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\factories\InventoryFactory;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id', 'variant_id', 'quantity'];

    /**
     * Get the product associated with this inventory record.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the variant associated with this inventory record.
     */
    public function variant()
    {
        return $this->belongsTo(Variant::class)->withDefault();
    }
}

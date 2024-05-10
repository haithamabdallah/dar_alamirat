<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id', 'size', 'color', 'material', 'sku', 'price'];

    /**
     * Get the product that owns the variant.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate the price of the variant after applying the product's discount.
     */
    public function getPriceWithDiscountAttribute()
    {
        $product = $this->product;

        if (!$product || !$product->discount_value || !$product->discount_type) {
            return $this->price; // Return the original price if no discount is applicable
        }
        $price = $this->price;
        if ($product->discount_type === 'flat') {
            $price -= $product->discount_value;
        } elseif ($product->discount_type === 'percent') {
            $price -= ($this->price * ($product->discount_value / 100));
        }

        return max($price, 0); // Ensure the price does not go below zero
    }

    public function getVariantNameAttribute()
    {
        $elements = [
                $this->size ?? '',
                $this->color ?? '',
        ];
        return implode('-', array_filter($elements));
    }

}

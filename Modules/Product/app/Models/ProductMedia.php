<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\factories\ProductMediaFactory;

class ProductMedia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id', 'file'];

    /**
     * Get the product that owns the media.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

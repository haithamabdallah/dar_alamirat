<?php

namespace Modules\Order\Models;

use Modules\Product\Models\Product;
use Modules\Product\Models\Variant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Order\Database\Factories\OrderProductFactory;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table='order_product';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['order_id','product_id', 'variant_id', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }}

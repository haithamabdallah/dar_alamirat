<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\VariantImageFactory;

class VariantImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];
    protected $guarded = ['id'];

    // protected static function newFactory(): VariantImageFactory
    // {
    //     //return VariantImageFactory::new();
    // }
}

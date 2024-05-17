<?php

namespace Modules\Brand\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Models\Product;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use HasFactory , HasTranslations;

    protected $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'  , 'image'  , 'status' ];

    /**
     * Get the products for the Brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}

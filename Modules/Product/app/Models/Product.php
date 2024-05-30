<?php

namespace Modules\Product\Models;

use App\Models\User;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Order\Models\Order;
use Modules\Product\app\ModelFilters\ProductFilter;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory , HasTranslations ,Filterable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'instructions',
        'thumbnail',
        'active',
        'slug',
        'category_id',
        'brand_id',
        'discount_type',
        'discount_value',
        'most_sale',
        'choice',
    ];

    public $translatable = ['title', 'description', 'instructions'];

    /**
     * Get the category associated with the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the brand associated with the product.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Get the variants for the product.
     */
    public function variants()
    {
        return $this->hasMany(Variant::class);
    }


    /**
     * Get the media for the product.
     */
    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function inventory()
    {
        return $this->hasManyThrough(Inventory::class, Variant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price','variant_id','product_id','order_id');
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function getThumbnailAttribute()
    {
        if (isset($this->attributes['thumbnail']) && Storage::disk('public')->exists($this->attributes['thumbnail'])){
            return storage_asset($this->attributes['thumbnail']);
        }else{
            return asset('assets/images/image.png');
        }
    }


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function modelFilter()
    {
        return $this->provideFilter(ProductFilter::class);
    }

}

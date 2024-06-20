<?php

namespace Modules\Product\Models;

use App\Models\User;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\Models\Brand;
use Modules\Cart\Models\Cart;
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

    protected $with = ['media', 'variants'];

    public $translatable = ['title', 'description', 'instructions'];

    public $appends = ['price' , 'variant_prices' ];
    // public $appends = ['product_price' , 'currency'];


    # accessors

    public function getPriceAttribute()
    {
        // Check if there's a default variant
        $defaultVariant = $this->variants()?->first();

        // If default variant exists, return its price
        if ($defaultVariant) {
            return $defaultVariant?->priceWithDiscount;
        }

        // If no default variant, return null (or handle differently)
        return null;
    }
    public function getThumbnailAttribute()
    {
        if (isset($this->attributes['thumbnail']) && Storage::disk('public')->exists($this->attributes['thumbnail'])){
            return storage_asset($this->attributes['thumbnail']);
        }else{
            return asset('assets/images/image.png');
        }
    }
    public function getVariantPricesAttribute()
    {
        return $this->variants->map(function ($variant) {
            return $variant->only(['price_with_discount','id']);
        })->keyBy('id')->toJson();
    }


    /**
     * Get the media for the product.
     */
    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }

    # Relations
    
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

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }


    #scopes

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function modelFilter()
    {
        return $this->provideFilter(ProductFilter::class);
    }

    // # accessors 
    // public function getCurrencyAttribute()
    // {
    //     return     Setting::where('type' , 'general')->first()->value['currency'];
    // }
}

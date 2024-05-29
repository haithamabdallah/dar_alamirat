<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Modules\Product\Models\Product;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory , HasTranslations;

    protected $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name' , 'slug' , 'icon' , 'position' , 'priority', 'status' , 'type','parent_id'];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childes()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the products for the Category.
     */
    public function banners() {
        return $this->hasMany(Banner::class);
    }

    /**
     * Get the brands for the Category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function scopeMain($query)
    {
        return $query->where(['parent_id' => null , 'type' => 'default']);
    }

    public function getIconAttribute()
    {
        if (isset($this->attributes['icon']) && Storage::disk('public')->exists($this->attributes['icon'])){
            return storage_asset($this->attributes['icon']);
        }else{
            return asset('assets/images/default-category.png');
        }
    }

}

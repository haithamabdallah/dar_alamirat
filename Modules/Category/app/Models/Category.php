<?php

namespace Modules\Category\Models;

use App\Models\IndexPriority;
use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory , HasTranslations;

    protected $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name' , 'slug' , 'icon' , 'position' , 'priority', 'status' , 'type','parent_id'];

    // # accessors 

    // public function getNameAttribute()
    // {
    //     if( app()->isLocale('ar') && isset($this->name['ar']) ) {
    //         return $this->name['ar'] ;
    //     } else {
    //         return $this->name['en'] ;
    //     } 
        
    // }

    # relations 

    public function priority() : MorphOne
    {
        return $this->morphOne(IndexPriority::class, 'priorityable');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childes()
    {
        return $this->hasMany(Category::class, 'parent_id')->active();
    }

    /**
     * Get the banners for the Category.
     */
    // public function banners() {
    //     return $this->hasMany(Banner::class);
    // }
    public function banner() : MorphOne 
    { 
        return $this->morphOne(Banner::class , 'bannerable'); 
    }

    /**
     * Get the products for the Category.
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

    # overrides 
    public function delete()
    {
        $this->priority()->delete();
        parent::delete();
    }

}

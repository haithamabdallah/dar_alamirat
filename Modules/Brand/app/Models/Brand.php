<?php

namespace Modules\Brand\Models;

use Modules\Category\Models\Banner;
use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory , HasTranslations;

    protected $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'  , 'image'  , 'status' ];

    // protected $appends = ['name'];


    // # accessors 

    // public function getNameAttribute()
    // {
    //     if( app()->isLocale('ar') && isset($this->name['ar']) ) {
    //         return $this->name['ar'] ;
    //     } else {
    //         return $this->name['en'] ;
    //     } 
        
    // }
    
    
    #scopes 

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    # relations 

    /**
     * Get the products for the Brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function banner() : MorphOne 
    { 
        return $this->morphOne(Banner::class , 'bannerable'); 
    }

    
}

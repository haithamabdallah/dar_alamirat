<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
     * Get the brands for the Category.
     */
    public function brands()
    {
        return $this->hasMany(Banner::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}

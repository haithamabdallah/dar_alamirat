<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\factories\ProductMediaFactory;

class ProductMedia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = ['product_id', 'file'];
    protected $guarded = ['id'];
    

    public function getFileAttribute()
    {
        if (isset($this->attributes['file']) && Storage::disk('public')->exists($this->attributes['file'])){
            return storage_asset($this->attributes['file']);
        }else{
            return asset('assets/images/image.png');
        }
    }

    /**
     * Get the product that owns the media.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

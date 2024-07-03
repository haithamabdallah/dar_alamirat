<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    public function getImageAttribute()
    {
        if (isset($this->attributes['image']) && Storage::disk('public')->exists($this->attributes['image'])){
            return storage_asset($this->attributes['image']);
        }else{
            return asset('assets/images/image.png');
        }
    }

    // protected static function newFactory(): VariantImageFactory
    // {
    //     //return VariantImageFactory::new();
    // }
    
    # overrides 

    public function delete()
    {
        if ($this->image && Storage::exists($this->image)) 
        {
            Storage::delete($this->image);
        }
        parent::delete();
    }
}

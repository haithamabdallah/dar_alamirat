<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable =  ['category_id', 'priority', 'status' , 'image'];


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}

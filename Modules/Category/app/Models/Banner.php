<?php

namespace Modules\Category\Models;

use App\Models\IndexPriority;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $with= "bannerable";
    protected $appends = ["type"];

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable =  ['category_id', 'priority', 'status' , 'image'];
    protected $fillable =  ['priority', 'status' , 'image'];


    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    # accessors 

    public function getTypeAttribute() 
    {
        return array_reverse(explode('\\', $this->bannerable_type))[0];
    }

    # Relations 
    public function bannerable()
    {
        return $this->morphTo();
    }

    public function priority() : MorphOne
    {
        return $this->morphOne(IndexPriority::class, 'priorityable');
    }

    # overrides 
    public function delete()
    {
        $this->priority()->delete();
        parent::delete();
    }

}

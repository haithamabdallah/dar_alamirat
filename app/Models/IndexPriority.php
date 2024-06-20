<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IndexPriority extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['priorityable'];
    protected $appends = ['type'];
    

    # Accessors
    public function getTypeAttribute() : string
    {
        return array_reverse(explode('\\', $this->priorityable_type))[0];
    }
    # Relation
    public function priorityable() : MorphTo
    {
        return $this->morphTo();
    }
}

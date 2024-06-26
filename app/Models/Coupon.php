<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $append = ['user_usage_count'];

    public function getUserUsageCountAttribute()
    {
        return $this->users()->wherePivot('user_id', auth()->id())->count();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_users', 'coupon_id', 'user_id')->withTimestamps();
    }

    
}

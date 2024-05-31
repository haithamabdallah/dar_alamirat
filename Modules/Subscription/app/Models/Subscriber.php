<?php

namespace Modules\Subscription\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Subscription\Database\Factories\SubscriberFactory;

class Subscriber extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['email'];

    protected static function newFactory(): SubscriberFactory
    {
        //return SubscriberFactory::new();
    }
}

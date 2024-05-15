<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Database\Factories\SocialFactory;

class Social extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected  $table='social_media';
    protected $fillable = ['name','icon','value'];

    protected static function newFactory(): SocialFactory
    {
        //return SocialFactory::new();
    }
}

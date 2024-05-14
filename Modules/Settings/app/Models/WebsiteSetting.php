<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Database\Factories\WebsiteSettingFactory;

class WebsiteSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'description', 'address', 'logo'];

    protected static function newFactory(): WebsiteSettingFactory
    {
        //return WebsiteSettingFactory::new();
    }
}

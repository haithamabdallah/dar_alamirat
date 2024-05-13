<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Database\Factories\AnnouncementSettingFactory;

class AnnouncementSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['announcement_message'];

    protected static function newFactory(): AnnouncementSettingFactory
    {
        //return AnnouncementSettingFactory::new();
    }
}

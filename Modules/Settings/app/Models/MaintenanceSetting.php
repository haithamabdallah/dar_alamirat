<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Settings\Database\Factories\MaintenanceSettingFactory;

class MaintenanceSetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['maintenance_mode','maintenance_title','maintenance_message'];

    protected static function newFactory(): MaintenanceSettingFactory
    {
        //return MaintenanceSettingFactory::new();
    }
}

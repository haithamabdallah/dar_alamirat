<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MainSlider extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $appends = ['title' , 'subtitle' , 'button_text'];

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en  ;
    }

    public function getSubtitleAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->subtitle_ar : $this->subtitle_en  ;
    }

    public function getButtonTextAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->button_text_ar : $this->button_text_en  ;
    }

    # Scopes 

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    # Overrides 

    public function delete()
    {
        if ($this->image && Storage::exists($this->image)) 
        {
            Storage::delete($this->image);
        }
        if ($this->background_image && Storage::exists($this->background_image)) 
        {
            Storage::delete($this->background_image);
        }
        parent::delete();
    }
}

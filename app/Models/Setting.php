<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'value',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'value' => 'json',
        ];
    }



    //  // Accessor for website_icon field
    //  public function getWebsiteIconAttribute($value)
    //  {
    //      if ($value) {
    //          return asset('storage/' . $value);
    //      }
    //      return null;
    //  }

    //  // Accessor for website_logo field
    //  public function getWebsiteLogoAttribute($value)
    //  {
    //      if ($value) {
    //          return asset('storage/' . $value);
    //      }
    //      return null;
    //  }
}

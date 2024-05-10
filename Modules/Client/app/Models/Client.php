<?php

namespace Modules\Client\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Client\Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['first_name','last_name','email','phone_number','birthday','gender'];

    public function getFullNameAttribute()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }


    public function setFullNameAttribute($value)
    {
        $names = explode(' ', $value, 2);
        $this->attributes['first_name'] = $names[0] ?? '';
        $this->attributes['last_name'] = $names[1] ?? '';
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    protected static function newFactory(): ClientFactory
    {
        //return ClientFactory::new();
    }
}

<?php

namespace Modules\Shipping\Models;

use Modules\Order\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Shipping\Database\Factories\ShippingFactory;

class Shipping extends Model
{
    use HasFactory , HasTranslations;

    protected $translatable = ['name'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name' , 'price' , 'duration' , 'status' ];


        public function orders()
        {
            return $this->hasMany(Order::class);
        }

}

<?php

namespace Modules\Order\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Modules\Client\Models\Client;
use Modules\Product\Models\Product;
use Modules\Shipping\Models\Shipping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id','shipping_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price','variant_id','product_id','order_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}

public function shippingMethod()
{
    return $this->belongsTo(Shipping::class);
}
// public function getOrderNumberAttribute($value)
// {
//     // Format UUID with dashes
//     return substr($value, 0, 8) . '-' . substr($value, 8, 4) . '-' . substr($value, 12, 4) . '-' . substr($value, 16, 4) . '-' . substr($value, 20);
// }
public function getOrderNumberAttribute($value)
{
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split($value, 4));
}


}

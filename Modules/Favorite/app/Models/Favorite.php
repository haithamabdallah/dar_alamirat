<?php

namespace Modules\Favorite\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Favorite\Database\Factories\FavoriteFactory;
use Modules\Product\Models\Product;

class Favorite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['user_id', 'product_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    use HasFactory;

}

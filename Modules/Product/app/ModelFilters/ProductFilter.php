<?php

namespace Modules\Product\app\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Support\Str;


class ProductFilter extends ModelFilter
{

    public function stringUpperToLower(string $value): string
    {
        return Str::lower($value);
    }

    public function search($search)
    {
        if (isStringEnglishLetters($search)) {
            return  $this->WhereHas('brand',function($q) use($search){
                $q->whereRaw("LOWER(JSON_UNQUOTE(JSON_EXTRACT(name, '$.en'))) LIKE ?", ["%{$this->stringUpperToLower($search)}%"]);
            });
        }

        if (isStringEnglishLetters($search) == false) {
            return $this->WhereHas('brand',function($q) use($search){
                $q->where('name','LIKE', "%{$search}%");
            });
        }
    }

    public function startPrice($price)
    {
        return  $this->where('price' ,'>=', $price);
    }

    public function endPrice($price)
    {
        return  $this->where('price' ,'<=', $price);
    }


    public function status($status)
    {
        return $this->where('status',$status);
    }

    public function brand($brandId)
    {
        return $this->where('brand_id',$brandId);
    }

    public function allBrands($allBrands)
    {
        return $this->whereIn('brand_id',$allBrands);
    }


    public function title($title)
    {
        return $this->where('title', $title);
    }

}

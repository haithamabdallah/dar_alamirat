<?php

namespace Modules\Brand\app\ViewModels;

use Modules\Brand\Models\Brand;
use Spatie\ViewModels\ViewModel;

class BrandViewModel extends ViewModel
{
    public Brand $brand;

    public function __construct($brand = null)
    {
        $this->brand = is_null($brand) ? new Brand(old()) : $brand;
    }

    public function action(): string
    {
        return is_null($this->brand->id)
            ? route('brand.store')
            : route('brand.update', ['brand' => $this->brand->id]);
    }

    public function method(): string
    {
        return is_null($this->brand->id) ? 'POST' : 'PUT';
    }

}

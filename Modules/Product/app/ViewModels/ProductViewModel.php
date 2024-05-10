<?php

namespace Modules\Product\app\ViewModels;

use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Product\Models\Product;
use Spatie\ViewModels\ViewModel;

class ProductViewModel extends ViewModel
{
    public Product $product;
    public $categories;
    public $brands;

    public function __construct($product = null)
    {
        $this->product = is_null($product) ? new Product(old()) : $product;
        $this->categories = Category::get();
        $this->brands = Brand::get();

    }

    public function action(): string
    {
        return is_null($this->product->id)
            ? route('product.store')
            : route('product.update', ['product' => $this->product->id]);
    }

    public function method(): string
    {
        return is_null($this->product->id) ? 'POST' : 'PUT';
    }

}

<?php

namespace Modules\Category\app\ViewModels;

use Modules\Category\Models\Category;
use Spatie\ViewModels\ViewModel;

class CategoryViewModel extends ViewModel
{
    public Category $category;

    public function __construct($category = null)
    {
        $this->category = is_null($category) ? new Category(old()) : $category;
    }

    public function action(): string
    {
        return is_null($this->category->id)
            ? route('category.store')
            : route('category.update', ['category' => $this->category->id]);
    }

    public function method(): string
    {
        return is_null($this->category->id) ? 'POST' : 'PUT';
    }

}

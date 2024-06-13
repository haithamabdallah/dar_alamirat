<?php

namespace Modules\Category\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;

class CategoryService {

    public function getAllData()
    {
        return Category::where('type','default')->orderByRaw('ISNULL(priority), priority ASC')->get();
    }

    public function getPaginatedData(array $data = [],int $count = 20 )
    {
        return  Category::where('type','default')->orderByRaw('ISNULL(priority), priority ASC')->paginate($count);
    }

    public function getAllcategoriesForSelectElement()
    {
        return category::pluck('name', 'id')->toArray();  
    }


    public function storeData(array $data)
    {
        $data['slug'] = isset($data['name']) ? Str::slug($data['name']['en']) : '';

        $category = Category::create($data);

        return  $category;
    }

    public function updateData(array $data , $category)
    {

        $data['slug'] = Str::slug($data['name']['en']);

        $category->update($data);

        return  $category;
    }

}

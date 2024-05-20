<?php

namespace Modules\Category\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;

class CategoryService {

    public function getAllData()
    {
        return Category::orderByRaw('ISNULL(priority), priority ASC')->get();
    }

    public function getPaginatedData(array $data = [],int $paginate = 20 )
    {
        return  Category::with('banners')->where('type','default')->orderByRaw('ISNULL(priority), priority ASC')->paginate($paginate);
    }

    public function getBannersData(array $data = [],int $paginate = 20 )
    {
        return  Category::where('type','banner')->orderByRaw('ISNULL(priority), priority ASC')->paginate($paginate);
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

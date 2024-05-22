<?php

namespace Modules\Category\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Category\Models\Banner;
use Modules\Category\Models\Category;

class BannerService {

    public function getAllData()
    {
        return Banner::orderByRaw('ISNULL(priority), priority ASC')->get();
    }

    public function getPaginatedData(array $data = [],int $paginate = 20 )
    {
        return  Banner::orderByRaw('ISNULL(priority), priority ASC')->paginate($paginate);
    }

    public function getBannersData(array $data = [],int $paginate = 20 )
    {
        return  Banner::where('type','banner')->orderByRaw('ISNULL(priority), priority ASC')->paginate($paginate);
    }

    public function storeData(array $data)
    {
        $category = Category::create([
            'type' => 'banner',
            'name' => '',
            'slug' => '',
            'priority' => $data['priority'],
        ]);

        $data['category_id'] = $category->id;

        $banner = Banner::create(Arr::only($data, ['category_id' , 'image']));
        return  $banner;
    }

    public function updateData(array $data , $banner)
    {
        $banner->category()->update($data);

        return  $banner;
    }

}

<?php

namespace Modules\Category\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Category\Models\Banner;

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
        $banner = Banner::create($data);
        return  $banner;
    }

    public function updateData(array $data , $banner)
    {

        $banner->update($data);

        return  $banner;
    }

}

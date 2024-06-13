<?php

namespace Modules\Category\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Brand\Models\Brand;
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
        $data = collect( $data );

        if (isset($data['image'])) {
            $image = $data['image'];
            $imagePath = $image->store("banners/{$data['type']}", 'public');
            $data['image'] = $imagePath;
        }

        if ( $data['type'] == 'category' ) {
            $bannerable = Category::find($data['bannerableId']);
        }

        if ( $data['type'] == 'brand' ) {
            $bannerable = Brand::find($data['bannerableId']);
        }

        $banner = $bannerable->banner()->create($data->only(['priority' , 'image'])->toArray());


        return  $banner;
    }

    public function updateData(array $data , $banner)
    {
        $banner->category()->update($data);

        return  $banner;
    }

}

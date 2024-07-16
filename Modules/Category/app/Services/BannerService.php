<?php

namespace Modules\Category\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Brand\Models\Brand;
use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Banner;
use Modules\Category\Models\Category;

class BannerService {

    public function getAllData()
    {
        return Banner::latest()->get();
    }

    public function getPaginatedData(array $data = [],int $paginate = 20 )
    {
        // return  Banner::latest()->paginate($paginate);
        return  Banner::latest()->get();
    }

    public function getBannersData(array $data = [],int $paginate = 20 )
    {
        return  Banner::where('type','banner')->latest()->paginate($paginate);
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
        try {
        DB::beginTransaction();

        $banner = $bannerable->banner()->create($data->only(['priority' , 'image'])->toArray());

        $banner->priority()->create([]);

        DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();
        }

        return  $banner;
    }

    public function updateData(array $data , $banner)
    {
        $banner->category()->update($data);

        return  $banner;
    }

}

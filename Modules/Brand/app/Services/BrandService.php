<?php

namespace Modules\Brand\app\Services;

use Illuminate\Support\Str;
use Modules\Brand\Models\Brand;

class BrandService {

    public function getAllData()
    {
        return Brand::latest()->get();
    }

    public function getPaginatedData(array $data ,int $paginate = 1 )
    {
        // return  Brand::latest()->paginate($paginate);
        return  Brand::latest()->get();

    }

    public function getAllBrandsForSelectElement()
    {
        return Brand::pluck('name', 'id')->toArray();  
    }

    public function storeData(array $data)
    {
        $brand = Brand::create($data);

        return  $brand;
    }

    public function updateData(array $data , $brand)
    {
        $brand->update($data);

        return  $brand;
    }

}

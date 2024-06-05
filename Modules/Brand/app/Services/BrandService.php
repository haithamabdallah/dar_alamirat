<?php

namespace Modules\Brand\app\Services;

use Illuminate\Support\Str;
use Modules\Brand\Models\Brand;

class BrandService {

    // public function getAllData()
    // {
    //     return Brand::orderBy('id','DESC')->get();
    // }

    // public function getPaginatedData(array $data ,int $paginate = 1 )
    // {
    //     return  Brand::paginate($paginate);
    // }
    public function getData(array $data, int $paginate = null)
    {
        $query = Brand::orderBy('id', 'DESC');

        if ($paginate !== null) {
            return $query->paginate($paginate);
        }

        return $query->get();
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

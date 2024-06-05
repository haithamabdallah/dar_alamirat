<?php

namespace Modules\Shipping\Services;

use Modules\Shipping\Models\Shipping;

class ShippingService
{
    public function handle()
    {
        //
    }

    public function getAllData()
    {
        return Shipping::latest()->get();
    }

    public function getPaginatedData(array $data = [] ,int $paginate = 10 )
    {
        return  Shipping::latest()->paginate($paginate);
    }

    public function storeData(array $data)
    {
        $shipping = Shipping::create($data);

        return  $shipping;
    }

    public function updateData(array $data , $shipping)
    {

        $shipping->update($data);

        return  $shipping;
    }
}

<?php

namespace Modules\Shipping\app\ViewModels;

use Modules\Shipping\Models\Shipping;
use Spatie\ViewModels\ViewModel;

class ShippingViewModel extends ViewModel
{
    public Shipping $shipping;

    public function __construct($shipping = null)
    {
        $this->shipping = is_null($shipping) ? new Shipping(old()) : $shipping;
    }

    public function action(): string
    {
        return is_null($this->shipping->id)
            ? route('shipping.store')
            : route('shipping.update', ['shipping' => $this->shipping->id]);
    }

    public function method(): string
    {
        return is_null($this->shipping->id) ? 'POST' : 'PUT';
    }

}

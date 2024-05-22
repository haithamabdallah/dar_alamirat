<?php

namespace Modules\Category\app\ViewModels;

use Modules\Category\Models\Banner;
use Modules\Category\Models\Category;
use Spatie\ViewModels\ViewModel;

class BannerViewModel extends ViewModel
{
    public Banner $banner;

    public function __construct( $banner = null)
    {
        $this->banner = is_null($banner) ? new Banner(old()) : $banner;
    }

    public function action(): string
    {
        return is_null($this->banner->id)
            ? route('banner.store')
            : route('banner.update', ['banner' => $this->banner->id]);
    }

    public function method(): string
    {
        return is_null($this->banner->id) ? 'POST' : 'PUT';
    }

}

<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Product\Models\ProductMedia;
use Modules\Product\Models\VariantImage;

class ImageController extends Controller
{
    public function deleteProductImage(ProductMedia $productMedia)
    {
        $productMedia->delete();
        return redirect()->back()->with("success", __("Deleted Successfully."));
    }

    public function deleteVariantImage(VariantImage $variantImage)
    {
        $variantImage->delete();
        return redirect()->back()->with("success", __("Deleted Successfully."));
    }



}

<?php

namespace App\Exports;

use Modules\Product\Models\Variant;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $variants = Variant::with('product.category' , 'product.brand' , 'product.media' , 'inventory'  , 'images' )->get()->map(function( $variant ){
            return [
                $variant->product->getTranslations('title')['ar'] ?? '',            // Product Name
                $variant->product->getTranslations('title')['en'] ?? '',
                $variant->product->getTranslations('description')['ar'] ?? '',
                $variant->product->getTranslations('description')['en'] ?? '',
                $variant->product->getTranslations('instructions')['ar'] ?? '',
                $variant->product->getTranslations('instructions')['en'] ?? '',
                $variant->product->thumbnail,
                $variant->media[0]['file'] ?? '',
                $variant->media[1]['file'] ?? '',
                $variant->product->category->getTranslations('name')['ar'] ?? '',          // Product Category
                $variant->product->category->getTranslations('name')['en'] ?? '',          // Product Category
                $variant->product->brand->getTranslations('name')['ar'] ?? '',          // Product Brand
                $variant->product->brand->getTranslations('name')['en'] ?? '',          // Product Brand
                $variant->product->discount_type,          
                $variant->product->discount_value,          
                $variant->product->is_returnable == 1 ? 'yes' : 'no',
                $variant->color,
                $variant->size,
                $variant->sku, 
                $variant->inventory_quantity,         
                $variant->price,          
                $variant->images[0]['image'] ?? '',          
                $variant->images[1]['image'] ?? '',          
            ];            
        });    

        $variants->prepend(
            [
                'اسم المنتج',            // Product Name
                'product name',
                'وصف المنتج',            // Product Description
                'product description',
                'كيفية استعمال المنتج',  // Product Instructions
                'product instructions',
                'product main image url',
                'product image 1',
                'product image 2',
                'تصنيف المنتج',          // Product Category
                'product category',
                'ماركة المنتج',          // Product Brand
                'product brand',
                'discount type (flat or percent)',
                'discount value',
                'Is product returnable (yes or no)',
                'variant color',
                'variant size',
                'variant sku',
                'variant quantity',
                'variant price',
                'variant image 1',
                'variant image 2'
            ]
        );

        return $variants; 
    }
}

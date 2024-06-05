<?php

namespace Modules\Product\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\Product\Models\Inventory;
use Modules\Product\Models\Product;

class ProductService {

    public function getAllData()
    {
        return Product::orderByRaw('ISNULL(priority), priority ASC')->get();
    }

    public function getPaginatedData(int $paginate = 20 )
    {

        return  Product::paginate($paginate);
    }

    public function getFilteredData(array $data ,int $paginate = 15, $order = 'ASC')
    {
        return  Product::filter($data)->active()->orderBy('priority',$order)->paginate($paginate);
    }


    public function storeData(array $data)
    {
        $createdData = Arr::except($data, ['variant' , 'images' , '_wysihtml5_mode']);
        $createdData['slug'] = Str::slug($createdData['title']['en']);

        $product = Product::create($createdData);

        // Handle variants
        foreach ($data['variant'] as $variantData) {
            if ($variantData['enabled'] === 'on') {
                $variant = $product->variants()->create([
                    'size' => $variantData['size'] ?? null,
                    'color' => $variantData['color'] ?? null,
                    'price' => $variantData['price'],
                    'quantity' => $variantData['quantity'],
                    'sku' => $this->generateSKU($variantData, $product->id)
                ]);

                // Create inventory record
                Inventory::create([
                    'product_id' => $product->id,
                    'variant_id' => $variant->id,
                    'quantity' => $variantData['quantity']
                ]);
            }
        }

        return  $product;
    }

    private function generateSKU($variantData, $productId)
    {
        $elements = [
            $productId,
                $variantData['size'] ?? '',
                $variantData['color'] ?? '',
        ];
        return implode('-', array_filter($elements)); // Combine elements to form SKU
    }

    // public function updateData(array $data , $category)
    // {

    //     $data['slug'] = Str::slug($data['name']['en']);

    //     $category->update($data);

    //     return  $category;
    // }
    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function updateData(Product $product, array $data)
    {
        $product->update($data);

        // Handle translations
        foreach (Config('language') as $key => $lang) {
            if (isset($data['title'][$key])) {
                $product->setTranslation('title', $key, $data['title'][$key]);
            }
            if (isset($data['description'][$key])) {
                $product->setTranslation('description', $key, $data['description'][$key]);
            }
            if (isset($data['instructions'][$key])) {
                $product->setTranslation('instructions', $key, $data['instructions'][$key]);
            }
        }

        $product->save();
    }


}

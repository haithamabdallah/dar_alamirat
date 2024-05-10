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

    public function getPaginatedData(array $data = [] ,int $paginate = 20 )
    {
        return  Product::paginate($paginate);
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

    public function updateData(array $data , $category)
    {

        $data['slug'] = Str::slug($data['name']['en']);

        $category->update($data);

        return  $category;
    }

}

<?php

namespace Modules\Product\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Models\Variant;
use Modules\Product\Models\Inventory;

class ProductService {

    public function getAllData()
    {
        return Product::orderByRaw('ISNULL(priority), priority ASC')->get();
    }

    public function getPaginatedData(int $paginate = 10 )
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
                    'sku' => $variantData['sku']
                ]);

                if ($variantData['images'] != false && count($variantData['images']) > 0) {
                    foreach ($variantData['images'] as $index => $image) 
                    {
                        $imagePath = $image->store("products/{$product->id}/variants/{$variant->id}/images", 'public');
                        $variant->images()->create(['image' => $imagePath]);
                    }
                }

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

    public function rules()
    {
        return [
            'title.*' => 'required|string|max:255',
            'description.*' => 'sometimes',
            'instructions.*' => 'sometimes',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'discount_type' => 'nullable|in:flat,percent',
            'discount_value' => 'nullable|numeric|min:0',
            'variant.*.size' => 'nullable|string|max:255',
            'variant.*.color' => 'nullable|string|max:255',
            'variant.*.price' => 'nullable|numeric|min:0',
            'variant.*.quantity' => 'nullable|integer|min:0',
            'variant.*.sku' => 'nullable|string|max:255|unique:variants,sku',
            'variant.*.images' => 'nullable|array',
            'variant.*.images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }

    public function saveProductData(Product $product, Request $request)
    {
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');

        $translations = ['title', 'description', 'instructions'];
        foreach ($translations as $field) {
            foreach (config('language') as $key => $lang) {
                $product->setTranslation($field, $key, $request->input("{$field}.{$key}"));
            }
        }

        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnailPath = $request->file('thumbnail')->store("products/{$product->id}/thumbnail", 'public');
            $product->thumbnail = $thumbnailPath;
        }

        $product->discount_type = $request->input('discount_type');
        $product->discount_value = $request->input('discount_value');

        $product->save();

     //   dd($request->variants);

        if ($request->filled('variant')) {
            foreach ($request->input('variant') as $variantData) {
                // Check if the variant is enabled before creating
                if (isset($variantData['enabled']) && $variantData['enabled'] === 'on') {
                    $variant = $product->variants()->create([
                        'size' => $variantData['size'] ?? null,
                        'color' => $variantData['color'] ?? null,
                        'price' => $variantData['price'],
                        'quantity' => $variantData['quantity'],
                        'sku' => $variantData['sku']
                    ]);

                    if ( isset($variantData['images']) && $variantData['images'] != false && count($variantData['images']) > 0) {
                        foreach ($variantData['images'] as $index => $image) 
                        {
                            $imagePath = $image->store("products/{$product->id}/variants/{$variant->id}/images", 'public');
                            $variant->images()->create(['image' => $imagePath]);
                        }
                    }

                    // Create inventory for the new variant
                    Inventory::create([
                        'product_id' => $product->id,
                        'variant_id' => $variant->id,
                        'quantity' => $variantData['quantity']
                    ]);
                }
            }
        }
        foreach ($request->variants as $index => $variantData) {
            // Check if the variant is enabled before updating
            // if (isset($variantData['enabled']) && $variantData['enabled'] === 'on') {
                // Get the variant by its ID
                $variant = Variant::findOrFail($variantData['id']);

                // Update the variant with the new price
                $variant->update([
                    'price' => $variantData['price'],
                    'sku' => $variantData['sku']
                ]);
                if ( isset($variantData['images']) && $variantData['images'] != false && count($variantData['images']) > 0) {
                    foreach ($variantData['images'] as $index => $image) 
                    {
                        $imagePath = $image->store("products/{$product->id}/variants/{$variant->id}/images", 'public');
                        $variant->images()->create(['image' => $imagePath]);
                    }
                }

                // Get the associated inventory for the variant
                $inventory = Inventory::where('variant_id', $variant->id)->first();

                if ($inventory) {
                    // Update the quantity in the inventory
                    $inventory->update([
                        'quantity' => $variantData['quantity']
                    ]);
                } else {
                    // If there is no inventory, create a new one
                    Inventory::create([
                        'product_id' => $product->id,
                        'variant_id' => $variant->id,
                        'quantity' => $variantData['quantity']
                    ]);
                // }
            }
        }

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

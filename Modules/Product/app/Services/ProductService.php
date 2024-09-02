<?php

namespace Modules\Product\app\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Product\Models\Product;
use Modules\Product\Models\Variant;
use Modules\Product\Models\Inventory;
use Modules\Brand\Models\Brand;
use Illuminate\Support\Facades\DB;
use Modules\Category\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductService {

    public function getAllData()
    {
        return Product::latest()->get();
    }

    public function getPaginatedData(int $paginate = 10 )
    {

        // return  Product::latest()->paginate($paginate);
        return  Product::latest()->get();
    }

    public function getFilteredData(array $data ,int $paginate = 15, $order = 'ASC')
    {
        return  Product::filter($data)->active()->latest()->paginate($paginate);
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

                if ( isset($variantData['images']) && $variantData['images'] != false && count($variantData['images']) > 0) {
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
    
    public function importDataFromExcelFile( $array )
    {
        try {

            DB::beginTransaction();

            $groupedProducts = collect($array)->groupBy('1');

            $savedVariants = 0;

            $mappedGroupedProducts = $groupedProducts->map(function ($productGroup, $productName) {

                $newGroupedProducts = [];

                # rename product keys

                $mappedProductGroup = collect($productGroup)->map(function ($product, $index) {

                    $newProduct = [];

                    $newProduct['category']['name']['ar']  = $product[9] ?? '';
                    $newProduct['category']['name']['en']  = $product[10] ?? '';

                    $newProduct['brand']['name']['ar']  = $product[11] ?? '';
                    $newProduct['brand']['name']['en']  = $product[12] ?? '';

                    $newProduct['product']['title']['ar']  = $product[0] ?? '';
                    $newProduct['product']['title']['en']  = $product[1] ?? '';
                    $newProduct['product']['description']['ar']  = $product[2] ?? '';
                    $newProduct['product']['description']['en']  = $product[3] ?? '';
                    $newProduct['product']['instructions']['ar']  = $product[4] ?? '';
                    $newProduct['product']['instructions']['en']  = $product[5] ?? '';
                    $newProduct['product']['discount_type']  = $product[13];
                    $newProduct['product']['discount_value']  = $product[14];
                    $newProduct['product']['is_returnable']  = $product[15] == 'true' ? 1 : 0;
                    $newProduct['product']['slug'] = Str::slug($newProduct['product']['title']['en']);

                    $newProduct['product']['thumbnail']  = $product[6];

                    $newProduct['variant']['color']  = $product[16];
                    $newProduct['variant']['size']  = $product[17];
                    $newProduct['variant']['sku']  = $product[18];
                    $newProduct['variant']['quantity']  = $product[19];
                    $newProduct['variant']['price']  = $product[20];

                    $newProduct['images']['product'] = [$product[7], $product[8]];
                    $newProduct['images']['variant']  = [$product[21], $product[22]];

                    return $newProduct;
                });

                return $mappedProductGroup;
            });

            // dd($mappedGroupedProducts->toArray());

            # handling product info

            foreach ($mappedGroupedProducts as $productName => $productGroup) {

                $product = $productGroup->first();
                # check for category

                $category = Category::when($product['category']['name']['en'] == true, function ($query) use ($product) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($product['category']['name']['en']) . '%']);
                })
                    ->when($product['category']['name']['ar'] == true, function ($query) use ($product) {
                        $query->orWhereRaw('LOWER(name) LIKE ?', ['%' . strtolower($product['category']['name']['ar']) . '%']);
                    })
                    ->first();

                if (!$category) {

                    $categoryData = [
                        'name' => $product['category']['name'],
                        'slug' => Str::slug($product['category']['name']['en']),
                    ];

                    $category = Category::create($categoryData);
                }

                $product['product']['category_id'] = $category->id;

                # check for brand

                $brand = Brand::when($product['brand']['name']['en'] == true, function ($query) use ($product) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($product['brand']['name']['en']) . '%']);
                })
                    ->when($product['brand']['name']['ar'] == true, function ($query) use ($product) {
                        $query->orWhereRaw('LOWER(name) LIKE ?', ['%' . strtolower($product['brand']['name']['ar']) . '%']);
                    })
                    ->first();

                if (!$brand) {
                    $brandData = [
                        'name' => $product['brand']['name'],
                    ];

                    $brand = Brand::create($brandData);
                }

                $product['product']['brand_id'] = $brand->id;

                $newStoredProduct = Product::create($product['product']);

                // handling thumbnail
                $imageContents = file_get_contents($product['product']['thumbnail']);
                $imageName = date('Y-m-d-H-i-s') . '-' .  rand(1000, 999999)  . '.'  . pathinfo($product['product']['thumbnail'], PATHINFO_EXTENSION);
                $path = "products/{$newStoredProduct->id}/thumbnail/{$imageName}";
                Storage::disk('public')->put($path, $imageContents);

                $newStoredProduct->thumbnail = $path;
                $newStoredProduct->save();

                // handling images
                foreach ($product['images']['product'] as $index => $imageUrl) {
                    if ($imageUrl == false) {
                        continue;
                    }
                    $imageContents = file_get_contents($imageUrl);
                    $imageName = date('Y-m-d-H-i-s') . '-' .  rand(1000, 999999)  . '.'  . pathinfo($imageUrl, PATHINFO_EXTENSION);
                    $path = "products/{$newStoredProduct->id}/images/{$imageName}";
                    Storage::disk('public')->put($path, $imageContents);
                    $newStoredProduct->media()->create(['file' => $path]);
                }

                # handling variant info

                foreach ($productGroup as $index => $variant) {
                    $variant['variant']['product_id'] = $newStoredProduct->id;
                    $newStoredVariant = Variant::create(collect($variant['variant'])->except('quantity')->toArray());

                    $savedVariants++;
                    // handling quantity
                    Inventory::create([
                        'product_id' => $newStoredVariant->product_id,
                        'variant_id' => $newStoredVariant->id,
                        'quantity' => $variant['variant']['quantity'],
                    ]);

                    // handling images
                    foreach ($variant['images']['variant'] as $index => $imageUrl) {
                        if ($imageUrl == false) {
                            continue;
                        }
                        $imageContents = file_get_contents($imageUrl);
                        $imageName = date('Y-m-d-H-i-s') . '-' .  rand(1000, 999999)  . '.'  . pathinfo($imageUrl, PATHINFO_EXTENSION);
                        $path = "products/{$newStoredProduct->id}/variants/{$newStoredVariant->id}/{$imageName}";
                        Storage::disk('public')->put($path, $imageContents);
                        $newStoredVariant->images()->create(['image' => $path]);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd( $e->getMessage() );
        }
        return $savedVariants;
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
            // 'variant.*.sku' => 'nullable|string|max:255|unique:variants,sku',
            'variant.*.sku' => 'nullable|string|max:255',
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
        if ( $request->has('variants') && $request->variants != false && count($request->variants) > 0) {
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

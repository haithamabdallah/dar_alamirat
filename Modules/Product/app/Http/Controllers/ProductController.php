<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Models\Product;
use Modules\Product\Models\Variant;
use Illuminate\Http\RedirectResponse;
use Modules\Product\Models\Inventory;
use Illuminate\Support\Facades\Validator;
use Modules\Product\app\Services\ProductService;
use Modules\Product\app\ViewModels\ProductViewModel;
use Modules\Product\Http\Requests\StoreProductRequest;
use Modules\Product\Http\Requests\UpdateProductRequest;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('permission:products.read,admin', ['only' => ['index']]);
        $this->middleware('permission:products.create,admin', ['only' => ['create', 'store']]);
        $this->middleware('permission:products.edit,admin', ['only' => ['edit', 'update']]);
        $this->middleware('permission:products.delete,admin', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getPaginatedData();

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.form' ,new ProductViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {

        $validatedData = $request->validated();

        $product = $this->productService->storeData($validatedData);

        // Handle thumbnail
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnailPath = $request->file('thumbnail')->store("products/{$product->id}/thumbnail", 'public');
            $product->update(['thumbnail' => $thumbnailPath]);
        }

        // Handle images
        if ($request->hasFile('images')) {
            foreach ($request->images as $image) {
                $imagePath = $image->store("products/{$product->id}/images", 'public');
                $product->media()->create(['file' => $imagePath]);
            }
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product)
    {

        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.form' ,new ProductViewModel($product));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateProductRequest $request, $id): RedirectResponse
    // {
    //     $validatedData = $request->validated();

    // // Find the product
    // $product = $this->productService->find($id);

    // // Update the product data
    // $this->productService->updateData($product, $validatedData);

    // // Handle thumbnail
    // if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
    //     $thumbnailPath = $request->file('thumbnail')->store("products/{$product->id}/thumbnail", 'public');
    //     $product->update(['thumbnail' => $thumbnailPath]);
    // }

    // Handle images
    // if ($request->hasFile('images')) {
    //     // First, delete the existing images if necessary
    //     $product->media()->delete();

    //     // Then, store the new images
    //     foreach ($request->images as $image) {
    //         $imagePath = $image->store("products/{$product->id}/images", 'public');
    //         $product->media()->create(['file' => $imagePath]);
    //     }
    // }

    // return redirect()->route('product.index')->with('success', 'Product updated successfully!');

    // }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::findOrFail($id);
        $this->saveProductData($product, $request);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    private function rules()
    {
        return [
            'title.*' => 'required|string|max:255',
            'description.*' => 'sometimes',
            'instructions.*' => 'sometimes',
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
        ];
    }

    private function saveProductData(Product $product, Request $request)
    {
        $product->category_id = $request->input('category_id');
        $product->brand_id = $request->input('brand_id');

        $translations = ['title', 'description', 'instructions'];
        foreach ($translations as $field) {
            foreach (config('language') as $key => $lang) {
                $product->setTranslation($field, $key, $request->input("{$field}.{$key}"));
            }
        }

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
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
                        'sku' => $this->generateSKU($variantData, $product->id)
                    ]);

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
                    'price' => $variantData['price']
                ]);

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

    private function generateSKU($variantData, $productId)
    {
        $elements = [
            $productId,
            $variantData['size'] ?? '',
            $variantData['color'] ?? '',
        ];
        return implode('-', array_filter($elements));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }

    public function toggleChoice(Request $request)
    {

    }
}

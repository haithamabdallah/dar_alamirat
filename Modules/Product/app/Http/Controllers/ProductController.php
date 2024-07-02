<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
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
        return view('dashboard.products.form', new ProductViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {

        $validatedData = $request->validated();

        try {
            DB::beginTransaction();
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

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
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
        return view('dashboard.products.form', new ProductViewModel($product));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->productService->rules());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);
            $this->productService->saveProductData($product, $request);

            // Handle images
            if ($request->hasFile('images')) {
                foreach ($request->images as $image) {
                    $imagePath = $image->store("products/{$product->id}/images", 'public');
                    $product->media()->create(['file' => $imagePath]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
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

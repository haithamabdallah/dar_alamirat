<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Imports\ExampleImport;
use App\Exports\ProductsExport;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Models\Product;
use Modules\Product\Models\Variant;
use Maatwebsite\Excel\Facades\Excel;
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
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
        ]);

        $products = Product::query()
            ->when(isset($validated['title']) && $validated['title'] != null, function ($query) use ($validated) {
                $query->where('title', 'like', '%' . $validated['title'] . '%');
            })
            ->when(isset($validated['sku']) && $validated['sku'] != null, function ($query) use ($validated) {
                $query->whereHas('variants', function ($query) use ($validated) {
                    $query->where('sku', 'like', '%' . $validated['sku'] . '%');
                });
            })
            ->when(isset($validated['category']) && $validated['category'] != null, function ($query) use ($validated) {
                $query->whereHas('category', function ($query) use ($validated) {
                    $query->where('name', 'like', '%' . $validated['category'] . '%');
                });
            })
            ->when(isset($validated['brand']) && $validated['brand'] != null, function ($query) use ($validated) {
                $query->whereHas('brand', function ($query) use ($validated) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($validated['brand']) . '%']);
                });
            })
            ->get();

        $isNotPaginated = true;

        return view('dashboard.products.search', compact('products', 'isNotPaginated'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->latest()->paginate(20);
        return view('dashboard.products.search', compact('products'));
    }

    public function all()
    {
        $products = Product::latest()->get();
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
        
            return redirect()->route('product.index')->with('success', 'Product created successfully!');

        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function importProductsFromExcelFileGet(Request $request)
    {
        return view('dashboard.products.import-excel-form');
    }

    public function importProductsFromExcelFilePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel' => 'required|mimes:xlsx',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $file = $request->file('excel'); // Ensure you have a file input named 'excel_file'

        $import = new ExampleImport();
        $array = Excel::toArray($import, $file);
        $array = $array[0];

        unset($array[0]);

        $rules = [];
        $rules["*.1"] = 'required';
        $rules["*.18"] = 'unique:variants,sku';

        $messages = [
            '*.*.required' => "Make sure that all fields are filled && there is no empty rows! Please check row #:attribute",
            '*.18.unique' => 'Make sure that all SKU fields are unique in your data file and in the stored data in the app! Please check row #:attribute',
        ];

        $validator2 = Validator::make($array, $rules , $messages);

        if ($validator2->fails()) {
            return redirect()->back()->withErrors($validator2)->withInput();
        }

        $savedVariants = $this->productService->importDataFromExcelFile( $array );
        
        return redirect()->back()->with('success', "$savedVariants records created successfully.");
    }

    public function exportProductsAsExcel()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
    
    public function DownloadExcelTemplate()
    {
        return response()->download(public_path('assets/others/product-excel-template.xlsx'));
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

            return redirect()->route('product.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
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

    public function toggleReturnable(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $product->is_returnable = $request->is_returnable != 'false' ? 1 : 0;
        $product->save();
        return response()->json(['success' => true]);
    }
}

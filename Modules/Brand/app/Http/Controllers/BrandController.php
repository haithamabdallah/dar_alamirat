<?php

namespace Modules\Brand\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Brand\Models\Brand;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Modules\Brand\app\Services\BrandService;
use Modules\Brand\app\ViewModels\BrandViewModel;
use Modules\Brand\Http\Requests\StoreBrandRequest;
use Modules\Brand\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
        ]);

        $brands = Brand::query()
            ->when( isset ( $validated ['name'] ) && $validated ['name'] != null , function ($query) use ($validated) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower( $validated ['name']) . '%']);
            })
            ->get();

        $isNotPaginated = true;

        return view('dashboard.brands.search' , compact('brands' , 'isNotPaginated'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::query()->latest()->paginate(20);
        return view('dashboard.brands.search', compact('brands'));
    }

    public function all()
    {
        $brands = Brand::latest()->get();
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.form' , new BrandViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $path = $request->file('image')->store('brand/img', 'public');
            $validatedData['image'] = $path;
        }

        $brand =$this->brandService->storeData($validatedData);
        if ($brand){
            Session()->flash('success', 'Brand Created Successfully');
        }else{
            Session()->flash('error', 'Brand didn\'t Created');

        }

        return redirect()->route('brand.index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('brand::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('dashboard.brands.form' , new BrandViewModel($brand));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }

            $path = $request->file('image')->store('brand/img', 'public');
            $validatedData['image'] = $path;
        }

        $brand =$this->brandService->updateData($validatedData , $brand);
        if ($brand){
            Session()->flash('success', 'Brand Updated Successfully');
        }else{
            Session()->flash('error', 'Brand didn\'t Created');

        }

        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        // Check if the admin has a photo and delete it from storage
        if ($brand->image && Storage::disk('public')->exists($brand->image)) {
            Storage::disk('public')->delete($brand->image);
        }
        // Delete the admin record
        $brand->delete();
        Session()->flash('success', 'Brand Deleted Successfully');
        return redirect()->back();
    }

    public function changeStatus(Request $request, Brand $brand)
    {
        $brand->status = !$brand->status;
        $brand->save();
        // $category->update(['status' => $request->status]);
        return response()->json(['message' => 'Status Changed Successfully'], 200);
    }
}

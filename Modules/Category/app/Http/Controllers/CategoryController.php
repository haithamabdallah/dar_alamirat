<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Category\app\Services\CategoryService;
use Modules\Category\app\ViewModels\CategoryViewModel;
use Modules\Category\Http\Requests\StoreCategoryRequest;
use Modules\Category\Http\Requests\UpdateCategoryRequest;
use Modules\Category\Models\Category;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        $this->middleware('permission:categories.read,admin', ['only' => ['index']]);
        $this->middleware('permission:categories.create,admin', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories.edit,admin', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories.delete,admin', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getPaginatedData();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.form' , new CategoryViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $category =$this->categoryService->storeData($validatedData);

        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            $path = $request->icon->store("category/{$category->id}/img", 'public');
            $category->update(['icon' => $path]);
        }

        if ($request->hasFile('banner_images')) {
            foreach ($request->banner_images as $image) {
                $imagePath = $image->store("category/{$category->id}/banners", 'public');
                $category->banners()->create(['image' => $imagePath]);
            }
        }
        if ($category){
            Session()->flash('success', 'Category Created Successfully');
        }else{
            Session()->flash('error', 'Category didn\'t Created');
        }

        return redirect()->route('category.index');
    }

    /**
     * Show the specified resource.
     */
    public function show(Category $category)
    {
        return view('category::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.form' , new CategoryViewModel($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('icon') && $request->file('icon')->isValid()) {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }

            $path = $request->file('icon')->store('category/img', 'public');
            $validatedData['icon'] = $path;
        }

        $category =$this->categoryService->updateData($validatedData , $category);
        if ($category){
            Session()->flash('success', 'Category Updated Successfully');
        }else{
            Session()->flash('error', 'Category didn\'t Created');

        }

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->icon && Storage::disk('public')->exists($category->icon)) {
            Storage::disk('public')->delete($category->icon);
        }

        $category->delete();
        Session()->flash('success', 'Category Deleted Successfully');
        return redirect()->back();
    }

    public function changeStatus(Request $request,Category $category)
    {
        $category->update(['status' => $request->status]);
        return response()->json(['message' => 'Status Changed Successfully'], 200);
    }
}

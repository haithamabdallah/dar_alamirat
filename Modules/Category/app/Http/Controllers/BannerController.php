<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Modules\Category\app\Services\BannerService;
use Modules\Category\app\ViewModels\BannerViewModel;
use Modules\Category\Http\Requests\StoreBannerRequest;
use Modules\Category\Http\Requests\UpdateBannerRequest;
use Modules\Category\Models\Banner;

class BannerController extends Controller
{
    protected $bannerService;

    public function __construct(BannerService $bannerService)
    {
        $this->bannerService = $bannerService;
        $this->middleware('permission:categories.read,admin', ['only' => ['index','bannersData']]);
        $this->middleware('permission:categories.create,admin', ['only' => ['create', 'store']]);
        $this->middleware('permission:categories.edit,admin', ['only' => ['edit', 'update']]);
        $this->middleware('permission:categories.delete,admin', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = $this->bannerService->getPaginatedData();
        return view('dashboard.categories.banners', compact('banners'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.banner_form' , new BannerViewModel());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            foreach ($request->image as $image) {

                $banner =$this->bannerService->storeData(['image' => $image , 'priority' => $validatedData['priority']]);

                $imagePath = $image->store("banners/{$banner->id}", 'public');
                $banner->update(['image' => $imagePath]);
            }
        }

        if ($banner){
            Session()->flash('success', 'Banner Created Successfully');
        }else{
            Session()->flash('error', 'Banner didn\'t Created');
        }

        return redirect()->route('banner.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('dashboard.categories.banner_form' , new BannerViewModel($banner));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }

            $path = $request->file('image')->store("banners/{$banner->id}", 'public');
            $validatedData['image'] = $path;
        }

        $banner =$this->bannerService->updateData($validatedData , $banner);

        if ($banner){
            Session()->flash('success', 'Banner Updated Successfully');
        }else{
            Session()->flash('error', 'Banner didn\'t Created');

        }

        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();
        Session()->flash('success', 'Banner Deleted Successfully');
        return redirect()->back();
    }

    public function changeStatus(Request $request,Banner $banner)
    {
        $banner->category()->update(['status' => $request->status]);
        return response()->json(['message' => 'Status Changed Successfully'], 200);
    }
}

<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Page\Models\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Page\Http\Requests\PageRequest;
use Modules\Page\app\ViewModels\PageViewModel;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages=Page::get();
        return view('dashboard.pages.pages',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.pages.create_page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request): RedirectResponse
    {
        //
        $validatedData = $request->validated();
        $page=Page::create($validatedData);

        if ($page)
        {
            Session()->flash('success', 'Page Created Successfully');
        }else{
            Session()->flash('error', 'Page didn\'t Created');

        }

        return redirect()->route('page.index');


    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $page=Page::find($id);
        return view('themes.theme1.page',compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page=Page::find($id);
        return view('dashboard.pages.edit_page',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
         // Retrieve the Page object
         $page = Page::findOrFail($id);

         // Validate the incoming request data
         $validatedData = $request->validate([
             'name' => 'required|array',
             'content' => 'required|array',
             'priority' => 'required|integer',
         ]);

         // Update the Page object with the validated data
         $page->name = $validatedData['name'];
         $page->content = $validatedData['content'];
         $page->priority = $validatedData['priority'];

         // Save the updated Page object
         $page->save();

         // Redirect the user to a relevant page
         return redirect()->route('page.index')->with('success', 'Page updated successfully.');
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $page=Page::find($id);
        $page->delete();
        return redirect()->route('page.index')->with('success','Page deleted successfully');
    }

public function toggleStatus(Request $request)
{
    $model = Page::findOrFail($request->modelId);

    // Toggle the status
    $model->status = !$model->status;
    $model->save();

    return response()->json(['success' => true]);
}
}

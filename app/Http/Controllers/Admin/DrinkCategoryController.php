<?php

namespace App\Http\Controllers\Admin;

use App\DrinkCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class DrinkCategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DrinkCategory::latest()->get();

        return view('admin.bar.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bar.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:features|max:255'
        ]);

        $category = new DrinkCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->save();

        Toastr::success('message', 'Drinks category created successfully.');
        return redirect()->route('admin.drink-categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DrinkCategory  $drinkCategory
     * @return \Illuminate\Http\Response
     */
    public function show(DrinkCategory $drinkCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DrinkCategory  $drinkCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(DrinkCategory $drinkCategory)
    {
        return view('admin.bar.categories.edit',compact('drinkCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DrinkCategory  $drinkCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrinkCategory $drinkCategory)
    {
        $drinkCategory->name = $request->name;
        $drinkCategory->slug = Str::slug($request->name);
        $drinkCategory->description = $request->description;
        $drinkCategory->save();

        Toastr::success('message', 'Category updated successfully.');
        return redirect()->route('admin.drink-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DrinkCategory  $drinkCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrinkCategory $drinkCategory)
    {
        $drinkCategory->delete();

        Toastr::success('message', 'Category deleted successfully.');
        return back();
    }
}

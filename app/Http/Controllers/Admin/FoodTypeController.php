<?php

namespace App\Http\Controllers\Admin;

use App\FoodType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Toastr;

class FoodTypeController extends Controller
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
        $types = FoodType::latest()->get();

        return view('admin.food.types.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.food.types.create');
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

        $type = new FoodType();
        $type->name = $request->name;
        $type->slug = Str::slug($request->name);
        $type->description = $request->description;
        $type->save();

        Toastr::success('message', 'Food type created successfully.');
        return redirect()->route('admin.food-types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodType  $foodType
     * @return \Illuminate\Http\Response
     */
    public function show(FoodType $foodType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodType  $foodType
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodType $foodType)
    {
        return view('admin.food.types.edit',compact('foodType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodType  $foodType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodType $foodType)
    {
        $foodType->name = $request->name;
        $foodType->slug = Str::slug($request->name);
        $foodType->description = $request->description;
        $foodType->save();

        Toastr::success('message', 'Type updated successfully.');
        return redirect()->route('admin.food-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodType  $foodType
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodType $foodType)
    {
        $foodType->delete();

        Toastr::success('message', 'Food type deleted successfully.');
        return back();
    }
}

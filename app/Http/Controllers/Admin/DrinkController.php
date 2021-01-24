<?php

namespace App\Http\Controllers\Admin;

use App\Drink;
use App\DrinkCategory;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Toastr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DrinkController extends Controller
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
        $drinks = Drink::latest()->get();

        return view('admin.bar.drinks.index',compact('drinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DrinkCategory::all();

        return view('admin.bar.drinks.create',compact('categories'));
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
            'name'          => 'required|unique:drinks|max:255',
            'price'         => 'required',
            'category_id'       => 'required',
            'description'   => 'required',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('drink')){
                Storage::disk('public')->makeDirectory('drink');
            }
            $foodimage = Image::make($image)->stream();
            Storage::disk('public')->put('drink/'.$imagename, $foodimage);

        }

        $item = new Drink();
        $item->name         = $request->name;
        $item->slug         = Str::slug($request->name);
        $item->price        = $request->price;
        $item->description  = $request->description;
        $item->status       = true;
        $item->drink_category_id      = $request->category_id;
        $item->image        = $imagename;
        $item->save();

        $gallary = $request->file('gallaryimage');
        if($gallary)
        {
            foreach($gallary as $images)
            {
                $currentDate = Carbon::now()->toDateString();
                $galimage['name'] = 'gallary-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                $galimage['food_id'] = $item->id;

                if(!Storage::disk('public')->exists('gallery/drink')){
                    Storage::disk('public')->makeDirectory('gallery/drink');
                }
                $roomimage = Image::make($images)->stream();
                Storage::disk('public')->put('gallery/drink/'.$galimage['name'], $roomimage);

                $item->gallery()->create($galimage);
            }
        }

        Toastr::success('message', 'Drink added successfully.');
        return redirect()->route('admin.food-items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function show(Drink $drink)
    {
        return view('admin.bar.drinks.show',compact('drink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function edit(Drink $drink)
    {
        $categories = DrinkCategory::all();

        return view('admin.bar.drinks.edit',compact('drink', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Drink $drink)
    {
        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('drink')){
                Storage::disk('public')->makeDirectory('drink');
            }
            if(Storage::disk('public')->exists('drink/'.$drink->image)){
                Storage::disk('public')->delete('drink/'.$drink->image);
            }
            $foodimage = Image::make($image)->stream();
            Storage::disk('public')->put('drink/'.$imagename, $foodimage);

        }else{
            $imagename = $drink->image;
        }

        $drink->name         = $request->name;
        $drink->slug         = Str::slug($request->name);
        $drink->price        = $request->price;
        $drink->description  = $request->description;
        $drink->drink_category_id      = $request->category_id;
        $drink->image        = $imagename;

        if ($request->status) {
            $drink->status = true;
        } else {
            $drink->status = false;
        }

        $drink->save();

        Toastr::success('message', 'Drink updated successfully.');
        return redirect()->route('admin.drinks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drink $drink)
    {
        $drink->delete();

        Toastr::success('message', 'Drink deleted successfully.');
        return back();

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\FoodItem;
use App\FoodType;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Toastr;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodItemController extends Controller
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
        // $foods = FoodItem::latest()->withCount('comments')->get();
        $foods = FoodItem::latest()->get();

        return view('admin.food.items.index',compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = FoodType::all();

        return view('admin.food.items.create',compact('types'));
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
            'name'          => 'required|unique:rooms|max:255',
            'price'         => 'required',
            'food_type_id'       => 'required',
            'description'   => 'required',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('food/item')){
                Storage::disk('public')->makeDirectory('food/item');
            }
            $foodimage = Image::make($image)->stream();
            Storage::disk('public')->put('food/item/'.$imagename, $foodimage);

        }

        $item = new FoodItem();
        $item->name         = $request->name;
        $item->slug         = Str::slug($request->name);
        $item->price        = $request->price;
        $item->description  = $request->description;
        $item->status       = true;
        $item->food_type_id      = $request->food_type_id;
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

                if(!Storage::disk('public')->exists('gallery/food')){
                    Storage::disk('public')->makeDirectory('gallery/food');
                }
                $roomimage = Image::make($images)->stream();
                Storage::disk('public')->put('gallery/food/'.$galimage['name'], $roomimage);

                $item->gallery()->create($galimage);
            }
        }

        Toastr::success('message', 'Food item added successfully.');
        return redirect()->route('admin.food-items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodItem  $foodItem
     * @return \Illuminate\Http\Response
     */
    public function show(FoodItem $foodItem)
    {
        // $foodItem = FoodItem::withCount('comments')->find($foodItem->id);

        return view('admin.food.items.show',compact('foodItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodItem  $foodItem
     * @return \Illuminate\Http\Response
     */
    public function edit(FoodItem $foodItem)
    {
        $types = FoodType::all();

        return view('admin.food.items.edit',compact('foodItem', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodItem  $foodItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FoodItem $foodItem)
    {
        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('food/item')){
                Storage::disk('public')->makeDirectory('food/item');
            }
            if(Storage::disk('public')->exists('food/item/'.$foodItem->image)){
                Storage::disk('public')->delete('food/item/'.$foodItem->image);
            }
            $foodimage = Image::make($image)->stream();
            Storage::disk('public')->put('food/item/'.$imagename, $foodimage);

        }else{
            $imagename = $foodItem->image;
        }

        $foodItem->name         = $request->name;
        $foodItem->slug         = Str::slug($request->name);
        $foodItem->price        = $request->price;
        $foodItem->description  = $request->description;
        $foodItem->food_type_id      = $request->type_id;
        $foodItem->image        = $imagename;

        if ($request->status) {
            $foodItem->status = true;
        } else {
            $foodItem->status = false;
        }

        $gallary = $request->file('gallaryimage');
        if($gallary){
            foreach($gallary as $images){
                if(isset($images))
                {
                    $currentDate = Carbon::now()->toDateString();
                    $galimage['name'] = 'gallary-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                    $galimage['food_id'] = $foodItem->id;

                    if(!Storage::disk('public')->exists('gallery/food')){
                        Storage::disk('public')->makeDirectory('gallery/food');
                    }
                    $foodimage = Image::make($images)->stream();
                    Storage::disk('public')->put('gallery/food/'.$galimage['name'], $foodimage);

                    $foodItem->gallery()->create($galimage);
                }
            }
        }

        $foodItem->save();

        Toastr::success('message', 'Food item updated successfully.');
        return redirect()->route('admin.food-items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodItem  $foodItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodItem $foodItem)
    {

        $foodItem->delete();

        Toastr::success('message', 'Food item deleted successfully.');
        return back();
    }

    public function galleryImageDelete(Request $request){

        $gallaryimg = GalleryImage::find($request->id)->delete();

        if(Storage::disk('public')->exists('gallery/food/'.$request->image)){
            Storage::disk('public')->delete('gallery/food/'.$request->image);
        }

        if($request->ajax()){

            return response()->json(['msg' => $gallaryimg]);
        }
    }

}

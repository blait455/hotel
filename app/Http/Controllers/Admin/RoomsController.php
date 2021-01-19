<?php

namespace App\Http\Controllers\Admin;

use App\Feature;
use App\Http\Controllers\Controller;
use App\Room;
use App\RoomImage;
use App\Type;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class RoomsController extends Controller
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
        $rooms = Room::latest()->get();

        return view('admin.rooms.index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $features = Feature::all();
        $types = Type::all();

        return view('admin.rooms.create',compact('features', 'types'));
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
            'type_id'       => 'required',
            'features'      => 'required',
            'beds'          => 'required',
            'floor'         => 'required',
            'description'   => 'required',
            'image'     => 'required|image|mimes:jpeg,jpg,png',
        ]);

        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('room')){
                Storage::disk('public')->makeDirectory('room');
            }
            $roomimage = Image::make($image)->stream();
            Storage::disk('public')->put('room/'.$imagename, $roomimage);

        }

        $room = new Room();
        $room->name         = $request->name;
        $room->slug         = Str::slug($request->name);
        $room->price        = $request->price;
        $room->beds         = $request->beds;
        $room->floor        = $request->floor;
        $room->description  = $request->description;
        $room->status       = true;
        $room->type_id      = ($request->type_id);
        $room->image        = $imagename;
        $room->save();
        $room->features()->attach($request->features);

        $gallary = $request->file('gallaryimage');
        if($gallary)
        {
            foreach($gallary as $images)
            {
                $currentDate = Carbon::now()->toDateString();
                $galimage['name'] = 'gallary-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                // $galimage['size'] = $images->getSize();
                $galimage['room_id'] = $room->id;

                if(!Storage::disk('public')->exists('room/gallery')){
                    Storage::disk('public')->makeDirectory('room/gallery');
                }
                $roomimage = Image::make($images)->stream();
                Storage::disk('public')->put('room/gallery/'.$galimage['name'], $roomimage);

                $room->gallery()->create($galimage);
            }
        }

        Toastr::success('message', 'Room added successfully.');
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        // $room = Room::withCount('comments')->find($room->id);

        return view('admin.rooms.show',compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $features = Feature::all();
        $types = Type::all();
        $room = Room::find($room->id);

        return view('admin.rooms.edit',compact('room', 'features', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $image = $request->file('image');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('room')){
                Storage::disk('public')->makeDirectory('room');
            }
            if(Storage::disk('public')->exists('room/'.$room->image)){
                Storage::disk('public')->delete('room/'.$room->image);
            }
            $roomimage = Image::make($image)->stream();
            Storage::disk('public')->put('room/'.$imagename, $roomimage);

        }else{
            $imagename = $room->image;
        }

        $room->name         = $request->name;
        $room->slug         = Str::slug($request->name);
        $room->price        = $request->price;
        $room->beds         = $request->beds;
        $room->floor        = $request->floor;
        $room->description  = $request->description;
        $room->type_id      = $request->type_id;
        $room->image        = $imagename;
        $room->features()->sync($request->features);

        if(isset($request->status)){
            $room->status = true;
        }else{
            $room->status = false;
        }

        $gallary = $request->file('gallaryimage');
        if($gallary){
            foreach($gallary as $images){
                if(isset($images))
                {
                    $currentDate = Carbon::now()->toDateString();
                    $galimage['name'] = 'gallary-'.$currentDate.'-'.uniqid().'.'.$images->getClientOriginalExtension();
                    // $galimage['size'] = $images->getSize();
                    $galimage['room_id'] = $room->id;

                    if(!Storage::disk('public')->exists('room/gallery')){
                        Storage::disk('public')->makeDirectory('room/gallery');
                    }
                    $roomimage = Image::make($images)->stream();
                    Storage::disk('public')->put('room/gallery/'.$galimage['name'], $roomimage);

                    $room->gallery()->create($galimage);
                }
            }
        }

        $room->save();

        Toastr::success('message', 'Room updated successfully.');
        return redirect()->route('admin.rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room = Room::find($room->id);
        $room->features()->detach();

        $room->delete();

        Toastr::success('message', 'Room deleted successfully.');
        return back();
    }

    public function galleryImageDelete(Request $request){

        $gallaryimg = RoomImage::find($request->id)->delete();

        if(Storage::disk('public')->exists('room/gallery/'.$request->image)){
            Storage::disk('public')->delete('room/gallery/'.$request->image);
        }

        if($request->ajax()){

            return response()->json(['msg' => $gallaryimg]);
        }
    }

}

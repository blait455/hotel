<?php

namespace App\Http\Controllers\Admin;

use App\Guest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\ReceptionistLedger;
use App\Room;
use Illuminate\Http\Request;
use Toastr;

class GuestController extends Controller
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
        $guests = Guest::latest()->get();

        return view('admin.guests.index',compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();

        return view('admin.guests.create', compact('rooms'));
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
            'name'      => 'required|unique:features|max:255',
            'email'     => 'required|email',
            'phone'     => 'required',
            'nights'    => 'required',
            'status'    => 'required'
        ]);

        $image = $request->file('pop');
        $slug  = Str::slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('pop')){
                Storage::disk('public')->makeDirectory('pop');
            }
            $pop = Image::make($image)->resize(100, 160)->save();
            Storage::disk('public')->put('pop/'.$imagename, $pop);
        }else{
            $imagename = 'default.png';
        }

        $guest = new Guest();
        $guest->room_id            =    $request->room_id;
        $guest->type               =    $request->type;
        $guest->name               =    $request->name;
        $guest->address            =    $request->address;
        $guest->profession         =    $request->profession;
        $guest->email              =    $request->email;
        $guest->phone              =    $request->phone;
        $guest->Veh_reg_no         =    $request->veh_reg_no;
        $guest->from               =    $request->from;
        $guest->to                 =    $request->to;
        $guest->Purpose            =    $request->purpose;
        $guest->nights             =    $request->nights;
        $guest->no_in_room         =    $request->no_in_room;
        $guest->nationality        =    $request->nationality;
        $guest->emergency_name     =    $request->emergency_name;
        $guest->emergency_phone    =    $request->emergency_phone;
        $guest->status             =    $request->status;
        $guest->save();

        $rl = new ReceptionistLedger();
        $rl->guest_id              =    $guest->id;
        $rl->room_id               =    $guest->room_id;
        $rl->payment_method        =    $request->payment_method;
        $rl->payment_type          =    $request->payment_type;
        $rl->pop                   =    $imagename;
        $rl->rc                    =    $request->rc;
        $rl->save();

        Toastr::success('message', 'Guest added successfully.');
        return redirect()->route('admin.guests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        $rooms = Room::all();
        return view('admin.guests.edit',compact('guest', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        $guest->room_id             =   $request->room_id;
        $guest->type                =   $request->type;
        $guest->name                =   $request->name;
        $guest->address             =   $request->address;
        $guest->profession          =   $request->profession;
        $guest->email               =   $request->email;
        $guest->phone               =   $request->phone;
        $guest->Veh_reg_no          =   $request->veh_reg_no;
        $guest->from                =   $request->from;
        $guest->to                  =   $request->to;
        $guest->Purpose             =   $request->purpose;
        $guest->nights              =   $request->nights;
        $guest->no_in_room          =   $request->no_in_room;
        $guest->nationality         =   $request->nationality;
        $guest->emergency_name      =   $request->emergency_name;
        $guest->emergency_phone     =   $request->emergency_phone;
        $guest->status              =   0;

        $guest->save();

        Toastr::success('message', 'Guest updated successfully.');
        return redirect()->route('admin.guests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        Toastr::success('message', 'Guest deleted successfully.');
        return back();
    }
}

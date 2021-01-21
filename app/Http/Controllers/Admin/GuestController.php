<?php

namespace App\Http\Controllers\Admin;

use App\Guest;
use App\Http\Controllers\Controller;
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
            'price'     => 'required',
            'status'    => 'required'
        ]);

        $guest = new Guest();
        $guest->room_id    = $request->room_id;
        $guest->name    = $request->name;
        $guest->email   = $request->email;
        $guest->phone   = $request->phone;
        $guest->nights  = $request->nights;
        $guest->price  = $request->price;
        $guest->status  = $request->status;
        $guest->save();

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
        $guest->room_id    = $request->room_id;
        $guest->name    = $request->name;
        $guest->email   = $request->email;
        $guest->phone   = $request->phone;
        $guest->nights  = $request->nights;
        $guest->price  = $request->price;
        $guest->status  = $request->status;

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

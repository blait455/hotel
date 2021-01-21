<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Guest;
use App\Http\Controllers\Controller;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;

class BookingsController extends Controller
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
        $bookings = Booking::latest()->get();

        return view('admin.bookings.index',compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::all();
        $users = User::all();

        return view('admin.bookings.create', compact('rooms', 'users'));
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
        ]);

        $guest = new Guest();
        $guest->room_id    = $request->room_id;
        $guest->name    = $request->name;
        $guest->email   = $request->email;
        $guest->phone   = $request->phone;
        $guest->nights  = $request->nights;
        $guest->price  = $request->price;
        $guest->status  = false;
        $guest->save();

        $booking = new Booking();
        $booking->guest_id = $guest->id;
        $booking->user_id = Auth::user()->hasAnyRoles(['admin', 'author']) ?  Auth::id() : '';
        $booking->room_id = $request->room_id;
        if(isset($request->status)){
            $booking->status = $request->status;
        }else{
            $booking->status = false;
        }
        $booking->save();

        if ($request->status) {
            $room = Room::find($request->room_id);
            $room->status = 2;
            $room->update();

            Toastr::success('message', 'Booked successfully and room has been reserved.');
        } else {
            Toastr::success('message', 'Booked successfully and room not reserved.');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $rooms = Room::all();
        return view('admin.bookings.edit',compact('booking', 'rooms'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Booking $booking)
    {

    }

    public function reserve($id) {
        $booking = Booking::find($id);
        $booking->status = true;
        $booking->update();

        $room = Room::find($booking->room_id);
        $room->status = 2;
        $room->update();

        Toastr::success('message', 'Booking updated successfully and room has been reserved.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $room = Room::find($booking->room_id);
        $room->status = true;
        $room->update();

        $booking->delete();

        Toastr::success('message', 'Booking deleted successfully and room is now available.');

        return back();
    }
}

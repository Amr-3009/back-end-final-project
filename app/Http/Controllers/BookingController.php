<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        return Booking::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'time' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'Number_of_people' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'status' => 'nullable|string|max:255'
        ]);
        $booking = Booking::create($validatedData);
        return response()->json(['msg' => 'Booking Created Successfully', 'Booking' => $booking]);
    }

    public function show(string $user_id)
    {
        return Booking::where('user_id', $user_id)->get();
    }

    public function acceptBooking(string $id)
    {
        $booking = Booking::where('id', $id)->first();
        $booking->status = 'Accepted';
        $booking->save();
        return response()->json(['msg' => 'Booking Accepted Successfully', 'Booking' => $booking]);
    }

    public function rejectBooking(string $id)
    {
        $booking = Booking::where('id', $id)->first();
        $booking->status = 'Rejected';
        $booking->save();
        return response()->json(['msg' => 'Booking Rejected Successfully', 'Booking' => $booking]);
    }
}
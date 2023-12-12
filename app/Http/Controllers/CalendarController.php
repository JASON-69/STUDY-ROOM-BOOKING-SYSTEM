<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    public function show(Request $request)
    {
        // $date = $request->date;
        // $date = date('Y-m-d', strtotime($date));
        // $bookings = Booking::where('date', $date)->get();
        // dd($request->date);
        if (auth()->user()->is_admin) {
            $bookings = Booking::all();
        } else {
            $bookings = Booking::where('user_id', auth()->user()->id)->get();
        }
        $bookingsGroup = $bookings->groupBy('startbydate');
        $array = collect([]);
        foreach ($bookingsGroup as $date => $bookings) {
            $array->push([
                'date' => $date,
                'markup' => view('partials.calendar', ['bookings' => $bookings])->render(),
            ]);
        }
        return response()->json(
            $array
        );
    }
}

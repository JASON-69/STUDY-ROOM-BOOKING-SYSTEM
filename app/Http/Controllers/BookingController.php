<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('application');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $date)
    {   
        $date = Carbon::parse($date)->format('Y-m-d');
        return view('application', compact('date'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookingRequest $request)
    {
        $request->validated();
        
        $booking = Booking::create([
            'purpose' => $request->purpose,
            'brief_description' => $request->brief_description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('home')->with('success', 'Booking request sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}

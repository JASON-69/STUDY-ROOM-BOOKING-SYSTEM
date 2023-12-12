<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatusEnum;
use App\Enums\UserRolesEnum;
use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Notifications\BookingCreated;
use App\Notifications\BookingUpdated;

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

        User::where('role_id', UserRolesEnum::Admin->value)->get()->each(function ($admin) use ($booking) {
            $admin->notify(new BookingCreated($booking));
        });

        return redirect()->route('home')->with('success', 'Booking request sent!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking, ?string $notificationId = null)
    {
        if ($notificationId) {
            auth()->user()->notifications()->where('id', $notificationId)->first()->markAsRead();
        }

        return view('showApplication', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        $booking->update([
            'booking_status' => BookingStatusEnum::APPROVED->value,
        ]);

        $booking->user->notify(new BookingUpdated($booking));

        return redirect()->route('home')->with('success', 'Booking request approved!');
    }

    public function reject(Booking $booking)
    {
        $booking->update([
            'booking_status' => BookingStatusEnum::REJECTED->value,
        ]);

        $booking->user->notify(new BookingUpdated($booking));
        
        return redirect()->route('home')->with('success', 'Booking request rejected!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('editApplication', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookingRequest $request, Booking $booking)
    {
        $request->validated();

        $booking->update([
            'purpose' => $request->purpose,
            'brief_description' => $request->brief_description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('home')->with('success', 'Booking request updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}

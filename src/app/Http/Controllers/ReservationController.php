<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('event')->latest()->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'event_id' => 'required|exists:events,id',
                'name' => 'required|max:50',
                'email' => 'required|email|max:255',
                'number_of_people' => 'required|integer|min:1|max:10',
                'reserved_at' => 'required|date|after:now',
            ],
            [
                'reserved_at.after' => '日時は、今より後の日時を選んでください。',
            ],
            [
                'name' => '名前',
            ]
        );

        Reservation::create($validated);

        return redirect()->route('events.show', $validated['event_id'])
            ->with('success', '予約しました');
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Reservation $reservation)
    {
    $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', '予約をキャンセルしました');
    }
}

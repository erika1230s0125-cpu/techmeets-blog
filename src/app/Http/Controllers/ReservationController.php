<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\ReservationService;
use App\Repositories\ReservationRepository;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{

    public function __construct(
        private ReservationService $reservationService,
        private ReservationRepository $reservationRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = $this->reservationRepository->getAll();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request)
    {
        $validated = $request->validated();

        $this->reservationService->createReservation($validated);

        return redirect()->route('events.show', $validated['event_id'])
            ->with('success', '予約しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $this->reservationService->deleteReservation($reservation);

        return redirect()->route('reservations.index')
            ->with('success', '予約をキャンセルしました');
    }
}

<?php

namespace App\Services;

use App\Models\Reservation;
use App\Repositories\ReservationRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationService
{
    public function __construct(
        private ReservationRepository $reservationRepository
    ) {}

    public function createReservation(array $data)
    {
        return DB::transaction(function () use ($data) {

            $reservation = $this->reservationRepository->create($data);

            Log::info('Reservation created', ['reservation_id' => $reservation->id]);

            return $reservation;
        });
    }

    public function deleteReservation(Reservation $reservation)
    {
        return DB::transaction(function () use ($reservation) {
            $this->reservationRepository->delete($reservation);

            Log::info('Reservation deleted', ['reservation_id' => $reservation->id]);
        });
    }
}

<?php

namespace App\Repositories;

use App\Models\Reservation;

class ReservationRepository
{
    public function getAll()
    {
        return Reservation::with('event')->latest()->paginate(10);
    }

    public function create(array $data)
    {
        return Reservation::create($data);
    }

    public function delete(Reservation $reservation)
    {
        return $reservation->delete();
    }
}

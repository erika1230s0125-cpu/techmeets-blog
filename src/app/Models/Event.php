<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'location',
        'starts_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
    ];

    // 1つのイベントには、たくさんの予約がある
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

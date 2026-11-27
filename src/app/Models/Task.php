<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'is_completed',
    ];

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'due_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

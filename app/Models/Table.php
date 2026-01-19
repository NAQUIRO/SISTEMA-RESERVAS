<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'number',
        'capacity',
        'location',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function isAvailable($date, $time)
    {
        $dateTime = $date . ' ' . $time;
        return !$this->reservations()
            ->where('reservation_date', $dateTime)
            ->where('status', '!=', 'cancelled')
            ->exists();
    }
}

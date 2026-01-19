<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'table_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'number_of_guests',
        'reservation_date',
        'status',
        'special_requests'
    ];

    protected $casts = [
        'reservation_date' => 'datetime'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}

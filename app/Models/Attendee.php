<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendee extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

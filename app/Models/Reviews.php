<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car() {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    public function booking() {
        return $this->belongsTo(Bookings::class, 'booking_id');
    }

    public function reply() {
        return $this->belongsTo(Replys::class, 'reply_id');
    }
}

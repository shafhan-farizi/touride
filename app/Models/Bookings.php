<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car()
    {
        return $this->belongsTo(Cars::class, 'car_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payments::class, 'payment_id');
    }

    public function review()
    {
        return $this->hasMany(Reviews::class, 'booking_id');
    }

    public function getCalculatedPriceAttribute()
    {
        return $this->car->rental_price * $this->period;
    }

    public function getCalculatedPriceWithAllAttribute()
    {
        return ($this->car->rental_price * $this->period) + $this->car->insurance + $this->car->service_fee;
    }

    protected $appends = ['calculated_price', 'calculated_price_with_all'];

    protected static function booted(): void
    {
        static::updated(function (Bookings $booking) {
            if ($booking->isDirty('status')) {
                if ($booking->status === 'completed' || $booking->status === 'canceled') {
                    $car = $booking->car;
                    if ($car) {
                        $car->update(['status' => 'available']);
                    }
                } else if ($booking->status === 'ongoing') {
                    $car = $booking->car;
                    if ($car) {
                        $car->update(['status' => 'rented']);
                    }
                }
            }
        });

        static::deleted(function (Bookings $booking) {
            $booking->car->status = 'available';
        });
    }
}

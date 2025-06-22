<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $guarded = ['id'];

    public function booking()
    {
        return $this->hasMany(Bookings::class, 'car_id');
    }
    
    public function review() {
        return $this->hasMany(Reviews::class, 'car_id');
    }
}

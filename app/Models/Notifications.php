<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(Notifications::class, 'user_id');
    }
}

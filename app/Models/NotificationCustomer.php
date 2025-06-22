<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationCustomer extends Model
{
    use HasFactory;

    protected $table = 'notification_customers';

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(NotificationCustomer::class, 'user_id');
    }
}

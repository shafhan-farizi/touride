<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Replys extends Model
{
    use HasFactory;

    protected $table = 'replys';

    protected $guarded = ['id'];

    public function review() {
        $this->hasOne(Reviews::class, 'reply_id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Bookings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function sendEmail($user_id, $booking_id)
    {
        $user = User::find($user_id);
        $booking = Bookings::find($booking_id);

        Mail::to('shafhan.fa@gmail.com')->send(new SendEmail($user, $booking));

        return response()->json(['success' => 'Email sent successfully.']);
    }
}

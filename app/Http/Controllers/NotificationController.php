<?php

namespace App\Http\Controllers;

use App\Models\NotificationCustomer;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class NotificationController extends Controller
{
    public static function send($id, $title, $message) {
        NotificationCustomer::create([
            'user_id' => $id,
            'title' => $title,
            'message' => $message
        ]);
    }

    public static function toAdmin($title, $message) {
        $admin = User::role('admin')->first();
        Notification::make()
            ->title($title)
            ->body($message)
            ->sendToDatabase($admin);
    }
}

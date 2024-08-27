<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function showNotifications()
    {
        $user = auth()->user();
        $notifications = $user->notifications;
        return view('notifications.index', compact('notifications'));
    }
}

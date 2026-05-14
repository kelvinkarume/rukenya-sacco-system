<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
{
    $notifications = auth()->user()
        ->notifications()
        ->latest()
        ->get();

    return view('member.notifications', compact('notifications'));
}

public function markAsRead($id)
{
    $notification = Notification::where('id', $id)
        ->where('user_id', auth()->id())
        ->first();

    if ($notification) {
        $notification->update(['is_read' => true]);
    }

    return back();
}


}

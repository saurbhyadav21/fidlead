<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notification;
class UserNotificationController extends Controller
{
    public function index()
    {
        // Get all notifications for the logged-in user
        $notifications = Notification::whereNull('user_id')
            ->orWhere('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Mark notifications as read
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }

    public function count()
    {
        // Get the count of unread notifications for the logged-in user
        $unreadCount = Notification::whereNull('user_id')
            ->orWhere('user_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['unread_count' => $unreadCount]);
    }
}

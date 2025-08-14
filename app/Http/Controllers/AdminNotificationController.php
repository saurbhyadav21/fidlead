<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Customer;
class AdminNotificationController extends Controller
{
    public function create(Request $request)
    {
        // Return a view to display the notification form
        $users = Customer::all();
        return view('admin.notifications.create',compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
    //    dd($request);
        // Check if the notification should be sent to all users
        if ($request->send_all == 1) {
            // Send notification to all users
            $users = Customer::all();
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => $request->title,
                    'message' => $request->message,
                    'is_read' => 0, // Mark as unread
                ]);
            }
            // dd($request);

        } else {
            // dd('ddd');
            // Send notification to specific users
            $request->validate([
                'user_ids' => 'required|array|min:1', // Ensure at least one user is selected
                'user_ids.*' => 'exists:customers,id',    // Ensure each selected user exists
            ]);
            // dd($request);
            foreach ($request->user_ids as $user_id) {
                Notification::create([
                    'user_id' => $user_id,
                    'title' => $request->title,
                    'message' => $request->message,
                    'is_read' => 0, // Mark as unread
                ]);
            }
        }

        return redirect()->route('admin.notifications.create')->with('success', 'Notification sent successfully.');
    }

    public function index()
    {
        // Get all notifications for the logged-in user
        $notifications = Notification::orderBy('created_at', 'desc')->get();

        // For each notification, manually retrieve the user details
        foreach ($notifications as $notification) {
            $notification->user_name = Customer::find($notification->user_id)->name ?? 'Unknown';
        }

        // dd($notification);
        return view('admin.notifications.show', compact('notifications'));
    }

}

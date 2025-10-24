<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($request->expectsJson()) {
            if ($request->has('unread_only') && $request->unread_only == 'true') {
                $notifications = $user->notifications()->unread()->orderBy('created_at', 'desc')->paginate(20);
            } else {
                $notifications = $user->notifications()->orderBy('created_at', 'desc')->paginate(20);
            }
            return response()->json($notifications);
        }

        $notifications = $user->notifications()->orderBy('created_at', 'desc')->paginate(20);

        if ($user->role === 'student') {
            return view('student.notifications.index', compact('notifications'));
        }

        return view('notifications.index', compact('notifications'));
    }

    public function unreadCount(Request $request)
    {
        $user = Auth::user();
        $count = $user->notifications()->unread()->count();

        return response()->json(['count' => $count]);
    }

    public function markAsRead(Request $request, $id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function markAllAsRead(Request $request)
    {
        $user = Auth::user();
        $user->notifications()->unread()->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function markMultipleRead(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer'
        ]);

        $user = Auth::user();
        $user->notifications()->whereIn('id', $request->ids)->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }
}

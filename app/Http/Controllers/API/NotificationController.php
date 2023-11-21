<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Retweet;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Mention;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class NotificationController extends Controller
{
    public function getNotifications(){
        $user = auth()->user();
        $notifications = $user->notifications();
        foreach ($notifications as $notification) {
            $notification->created_at = $this->formatTimeAgo($notification->created_at, Carbon::now());
        }
        return response()->json($notifications);
    }

    public function markAsRead($array){
        Notification::whereIn('NotificationID', $array)->update(['Read' => true]);
        return response()->json(['message' => 'All notifications marked as read successfully']);
    }
    public function deleteAllNotification($array)
    {
        Notification::whereIn('NotificationID', $array)->delete();
        return response()->json(['message' => 'All notifications deleted successfully']);
    }
    public function deleteNotification($id)
    {
        Notification::find($id)->delete();
        return response()->json(['message' => 'notification deleted successfully']);
    }
    private function formatTimeAgo($created_at, $now)
    {
        $diff = $created_at->diff($now);

        if ($diff->y > 0) {
            return $diff->y . 'y';
        } elseif ($diff->m > 0) {
            return $diff->m . 'm';
        } elseif ($diff->d > 0) {
            return $diff->d . 'd';
        } elseif ($diff->h > 0) {
            return $diff->h . 'h';
        } elseif ($diff->i > 0) {
            return $diff->i . 'm';
        } else {
            return $diff->s . 's';
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
     public function index()
    {
        return view('notifications.index')->with([
            'posts' => Post::paginate(9),
            'notifications' => auth()->user()->notifications()->paginate(5),
        ]);
    }
    

    public function destroy(DatabaseNotification $notification){
        $notification->delete();
        return redirect()->back();
    }

    public function read(DatabaseNotification $notification){
        $notification->markAsRead();
        return redirect()->back();
    }

    public function readAll($notification_ids){
        $arr_ids = json_decode($notification_ids);
        $notifications = DatabaseNotification::whereIn('id', $arr_ids)->get();
        foreach($notifications as $notification) {
            $notification->markAsRead();
        }
    return redirect()->back();
    }
}

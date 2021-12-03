<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth');
    }
    public function show(User $users, Notifications $notifications)
    {
        $recipient= Auth::user()->id;
        $notifications = Notifications::where('recipient', $recipient)->orderBy('id', 'desc')->get();
        $users = User::all();
        return view('layouts.show', compact('notifications', 'users'));
    }
    public function destroy( $id)
    {
        $notification = Notifications::findOrFail($id);
        $notification->delete();
        return redirect('notification');
    }
}

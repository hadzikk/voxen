<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $title = 'Chat';
        $users = User::all();

        return view('chat.index', [
            'title' => $title,
            'users' => $users,
        ]);
    }

    public function personalChat($username) {
        $contacts = User::all();
        $user = User::where('username', $username)->first();
        $title = 'Chat';

        return view('chat.personal', 
        [
                'contacts' => $contacts,
                'user' => $user, 
                'title' => $title
        ]);
    }
}

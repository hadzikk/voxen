<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\Chat;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class ChatController extends Controller
{
    public function index()
    {
        $title = 'Chat';
        $user = Auth::user();
        $friends = User::all();
        
        return view('chat.index', [
            'title' => $title,
            'user' => $user,
            'friends' => $friends,
        ]);
    }
    
    public function group($username) 
    {   
        try {
            $title = 'Chat';
        
            $friends = User::all();

            $receiver = User::where('username', $username)->first();

            $messages = Message::where( function($query) use ($receiver) 
            {
                $query->where('sender_id', Auth::id())
                    ->where('receiver_id', $receiver->id);
            })->orWhere( function($query) use ($receiver)
            {
                $query->where('sender_id', $receiver->id)
                    ->where('receiver_id', Auth::id());
            })->orderBy('created_at')->get();
        } catch(Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }

        return view('chat.group', [
            'friends' => $friends,
            'receiver' => $receiver,
            'messages' => $messages,
            'title' => $title,
        ]); 
    }
    public function person($username)
    {
        $friends = User::all();
        $user = User::where('username', $username)->first();
        $title = 'Chat';
        $message = "hello world, this chat was sent using pusher!";

        broadcast(new Chat($message))->toOthers();

        return view('chat.personal', 
        [
                'friends' => $friends,
                'user' => $user, 
                'title' => $title
        ]);
    }


    public function send(Request $request) 
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => User::where('username', $request->username)->firstOrFail()->id,
            'message' => $request->message,
        ]);

        broadcast(new Chat($message))->toOthers();

        return response()->json(['status' => 'Message sent successfuly']);
    }

    public function friends()
    {
        $title = "Chat";
        $friends = User::all();

        return view('chat.friends', [
            'title' => $title,
            'friends' => $friends,
        ]);
    }

    public function addfriend()
    {
        $title = "Add friend";

        return view('chat.addfriend', ['title' => $title]);
    }

    public function conversations()
    {
        $title = "Chat";
        $conversations = [];

        return view('chat.group', [
            'title' => $title,
            'conversations' => $conversations,
        ]);
    }
}

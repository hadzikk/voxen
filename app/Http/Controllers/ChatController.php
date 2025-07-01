<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Events\Chat;
use App\Models\Message;
use App\Models\FriendRequest;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    public function addFriend()
    {
        $title = "Add friend";

        return view('chat.addfriend', ['title' => $title]);
    }

    public function searchFriend(Request $request)
    {
        $title = "Add friend";
        $authUser = auth()->user();
        $username = $request->username;

        $friend = null;
        $isFriend = false;
        $isPendingRequest = false;

        if ($username) {
            $friend = User::where('username', $username)
                        ->where('id', '!=', $authUser->id)
                        ->first();

            if ($friend) {
                // Cek apakah sudah berteman
                $isFriend = Friend::where(function($q) use ($authUser, $friend) {
                    $q->where('user_id', $authUser->id)->where('friend_id', $friend->id);
                })->orWhere(function($q) use ($authUser, $friend) {
                    $q->where('user_id', $friend->id)->where('friend_id', $authUser->id);
                })->exists();

                // Cek apakah ada request pending
                $isPendingRequest = FriendRequest::where(function($q) use ($authUser, $friend) {
                    $q->where('sender_id', $authUser->id)->where('receiver_id', $friend->id);
                })->orWhere(function($q) use ($authUser, $friend) {
                    $q->where('sender_id', $friend->id)->where('receiver_id', $authUser->id);
                })->where('status', 'pending')->exists();
            }
        }

        return view('chat.addfriend', [
            'title' => $title,
            'friend' => $friend,
            'isFriend' => $isFriend,
            'isPendingRequest' => $isPendingRequest,
        ]);
    }


    public function sendFriendRequest(Request $request)
    {
        $receiverId = $request->input('friend_id');
        $senderId = Auth::id();

        if ($receiverId == $senderId) {
            return back()->with('error', 'You can\'t send a friend request to yourself.');
        }

        $receiver = User::find($receiverId);
        if (!$receiver) {
            return back()->with('error', 'User not found.');
        }

        $alreadyFriend = Friend::where(function($q) use ($senderId, $receiverId) {
            $q->where('user_id', $senderId)->where('friend_id', $receiverId);
        })->orWhere(function($q) use ($senderId, $receiverId) {
            $q->where('user_id', $receiverId)->where('friend_id', $senderId);
        })->exists();

        if ($alreadyFriend) {
            return back()->with('error', 'You`re has been friends.');
        }

        $existingRequest = FriendRequest::where(function($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $senderId)
            ->where('receiver_id', $receiverId)
            ->where('status', 'pending');
        })->orWhere(function($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $receiverId)
            ->where('receiver_id', $senderId)
            ->where('status', 'pending');
        })->first();

        if ($existingRequest) {
            return back()->with('error', 'Friend request already sent.');
        }

        FriendRequest::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Friend request already sent.');
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

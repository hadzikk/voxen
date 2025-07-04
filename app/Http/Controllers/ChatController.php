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
        $user = Auth::user();
        $friends = $user->allFriends()->map(function ($f) {
        return $f->friend_id === Auth::id() ? $f->user : $f->friend;
        });

        return view('chat.friends', [
            'title' => $title,
            'friends' => $friends,
        ]);
    }

    public function friendrequest()
    {
        $title = "Chat";
        $user = Auth::user();
        $requests = $user->received_friend_requests()->with('sender')->get();

        return view('chat.friendrequest', [
            'title' => $title,
            'requests' => $requests,
        ]);
    }

    public function accept($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== Auth::id()) {
            abort(403);
        }

        $exists = Friend::where(function ($query) use ($request) {
            $query->where('user_id', Auth::id())
                ->where('friend_id', $request->sender_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('user_id', $request->sender_id)
                ->where('friend_id', Auth::id());
        })->exists();

        if (!$exists) {
            Friend::create([
                'user_id' => Auth::id(),
                'friend_id' => $request->sender_id,
            ]);

            Friend::create([
                'user_id' => $request->sender_id,
                'friend_id' => Auth::id(),
            ]);
        }

        $request->delete();

        return redirect('/chat/friendrequest')->with('success', 'Friend request accepted.');
    }


    public function decline($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== Auth::id()) {
            abort(403);
        }

        $request->delete();

        return redirect('/chat/friendrequest')->with('success', 'Friend request declined.');

    }

    public function addFriend()
    {
        $title = "Add friend";

        return view('chat.addfriend', ['title' => $title]);
    }

    public function searchFriend(Request $request)
    {
        $username = $request->input('username');
        $title = 'Add Friend';

        $friend = User::where('username', $username)
            ->where('id', '!=', Auth::id())
            ->first();

        $isFriend = false;
        $isPendingRequest = false;
        $isIncomingRequest = false;

        if ($friend) {
            $isFriend = Auth::user()->isFriendWith($friend->id);
            $isPendingRequest = FriendRequest::where('sender_id', Auth::id())
                                ->where('receiver_id', $friend->id)
                                ->exists();

            $isIncomingRequest = FriendRequest::where('sender_id', $friend->id)
                                ->where('receiver_id', Auth::id())
                                ->exists();
        }


        return view('chat.addfriend', compact(
    'title',
    'friend',
    'isFriend',
    'isPendingRequest',
    'isIncomingRequest'
));

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

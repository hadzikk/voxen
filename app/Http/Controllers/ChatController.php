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

    public function acceptFromSearch($sender_id, Request $request)
    {
        $authId = Auth::id();
        
        $friendRequest = FriendRequest::where('sender_id', $sender_id)
            ->where('receiver_id', $authId)
            ->first();

        if (!$friendRequest) {
            return redirect()->back()->with('error', 'Friend request not found.');
        }

        // Cek apakah sudah berteman
        $alreadyFriends = Friend::where(function ($query) use ($authId, $sender_id) {
            $query->where('user_id', $authId)
                ->where('friend_id', $sender_id);
        })->orWhere(function ($query) use ($authId, $sender_id) {
            $query->where('user_id', $sender_id)
                ->where('friend_id', $authId);
        })->exists();

        if (!$alreadyFriends) {
            Friend::create([
                'user_id' => $authId,
                'friend_id' => $sender_id,
            ]);

            Friend::create([
                'user_id' => $sender_id,
                'friend_id' => $authId,
            ]);
        }

        $friendRequest->delete();

        return redirect('/chat/friends/s?username=' . $request->username)->with('success', 'Friend request accepted.');
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
        $title = "Add friend";
        $authUser = auth()->user();
        $username = $request->username;

        $friend = null;
        $isFriend = false;
        $isSentRequest = false;
        $isReceivedRequest = false;

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

                // Cek apakah user login sudah mengirim request ke $friend
                $isSentRequest = FriendRequest::where('sender_id', $authUser->id)
                                    ->where('receiver_id', $friend->id)
                                    ->where('status', 'pending')
                                    ->exists();

                // Cek apakah user login menerima request dari $friend
                $isReceivedRequest = FriendRequest::where('sender_id', $friend->id)
                                        ->where('receiver_id', $authUser->id)
                                        ->where('status', 'pending')
                                        ->exists();
            }
        }

        return view('chat.addfriend', [
            'title' => $title,
            'friend' => $friend,
            'isFriend' => $isFriend,
            'isSentRequest' => $isSentRequest,
            'isReceivedRequest' => $isReceivedRequest,
        ]);
    }

    public function conversations()
    {
        $title = "Chat";

        $user = auth()->user();

        $conversations = $user->groups()->with('users')->get();

        return view('chat.group', [
            'title' => $title,
            'conversations' => $conversations,
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
            return back()->with('error', 'Youre has been friends.');
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

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Friend;
use App\Models\FriendRequest;

class FriendController extends Controller
{
    public function friendsList()
    {
        $user = auth()->user();
        $alreadyFriends = $user->allFriends()->map(fn($friendship) => 
            $friendship->friend_id === $user->id ? $friendship->user : $friendship->friend
        );

        return view('friends.list', [
            'title' => 'Friends',
            'alreadyFriends' => $alreadyFriends,
        ]);
    }

    public function friendsRequestsList()
    {
        $user = auth()->user();
        $requests = $user->received_friend_requests()->with('sender')->get();

        return view('friends.request', [
            'title' => 'Friend Requests',
            'receivedFriendRequests' => $requests,
        ]);
    }

    public function acceptFriendRequest($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!$this->areAlreadyFriends($request->sender_id, auth()->id())) {
            $this->createFriendship(auth()->id(), $request->sender_id);
        }

        $request->delete();

        return redirect()->route('friends.requests.list')->with('success', 'Friend request accepted.');
    }

    public function acceptFromSearch($senderId, Request $request)
    {
        $receiverId = auth()->id();

        $friendRequest = FriendRequest::where([
            ['sender_id', '=', $senderId],
            ['receiver_id', '=', $receiverId]
        ])->first();

        if (!$friendRequest) {
            return redirect()->back()->with('error', 'Friend request not found.');
        }

        if (!$this->areAlreadyFriends($senderId, $receiverId)) {
            $this->createFriendship($receiverId, $senderId);
        }

        $friendRequest->delete();

        return redirect()->route('friends.add', ['username' => $request->username])
            ->with('success', 'Friend request accepted.');
    }

    public function declineFriendRequest($id)
    {
        $request = FriendRequest::findOrFail($id);

        if ($request->receiver_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->delete();

        return redirect()->route('friends.requests.list')->with('success', 'Friend request declined.');
    }

    public function addFriend()
    {
        return view('friends.add-friend', [
            'title' => 'Add Friend',
        ]);
    }

    public function searchFriend(Request $request)
    {
        $authUser = auth()->user();
        $username = $request->username;

        $friend = null;
        $isFriend = $isSentRequest = $isReceivedRequest = false;

        if ($username) {
            $friend = User::where('username', $username)
                ->where('id', '!=', $authUser->id)
                ->first();

            if ($friend) {
                $isFriend = $this->areAlreadyFriends($authUser->id, $friend->id);

                $isSentRequest = FriendRequest::where([
                    ['sender_id', '=', $authUser->id],
                    ['receiver_id', '=', $friend->id],
                    ['status', '=', 'pending']
                ])->exists();

                $isReceivedRequest = FriendRequest::where([
                    ['sender_id', '=', $friend->id],
                    ['receiver_id', '=', $authUser->id],
                    ['status', '=', 'pending']
                ])->exists();
            }
        }

        return view('friends.add-friend', compact(
            'friend', 'isFriend', 'isSentRequest', 'isReceivedRequest'
        ) + ['title' => 'Add Friend']);
    }

    public function sendFriendRequest(Request $request)
    {
        $senderId = auth()->id();
        $receiverId = $request->input('friend_id');

        if ($senderId == $receiverId) {
            return back()->with('error', 'You cannot send a friend request to yourself.');
        }

        if (!User::find($receiverId)) {
            return back()->with('error', 'User not found.');
        }

        if ($this->areAlreadyFriends($senderId, $receiverId)) {
            return back()->with('error', 'You are already friends.');
        }

        $existingRequest = FriendRequest::where(function ($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $senderId)->where('receiver_id', $receiverId)
              ->orWhere('sender_id', $receiverId)->where('receiver_id', $senderId);
        })->where('status', 'pending')->exists();

        if ($existingRequest) {
            return back()->with('error', 'Friend request already pending.');
        }

        FriendRequest::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Friend request sent.');
    }

    // Helper: check if two users are already friends
    protected function areAlreadyFriends($userId1, $userId2): bool
    {
        return Friend::where(function ($query) use ($userId1, $userId2) {
            $query->where('user_id', $userId1)
                ->where('friend_id', $userId2);
        })->orWhere(function ($query) use ($userId1, $userId2) {
            $query->where('user_id', $userId2)
                ->where('friend_id', $userId1);
        })->exists();
    }

    protected function createFriendship($userId, $friendId): void
    {
        Friend::create(['user_id' => $userId, 'friend_id' => $friendId]);
        Friend::create(['user_id' => $friendId, 'friend_id' => $userId]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->slug = Str::slug($request->name) . '-' . Str::random(6);
        $group->description = $request->description;
        $group->owner_id = Auth::id();

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('groups', 'public');
            $group->profile_picture = $path;
        }

        $group->save();

        $group->users()->attach(auth()->id(), [
            'role' => 'owner',
            'status' => 'accepted',
        ]);

        return redirect()->back()->with('success', 'Grup berhasil dibuat!');
    }

    public function groupChat($slug)
    {   
        $group = Group::where('slug', $slug)->firstOrFail();
        $title = $group->name;
        $user = auth()->user();
        $conversations = $user->groups()->with('users')->get();

        return view('chat.groupchat', [
            'group' => $group,
            'title' => $title,
            'conversations' => $conversations,
        ]);
    }
}

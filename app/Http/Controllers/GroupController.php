<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $validated = $this->validateGroup($request);

        $group = $this->createGroup($validated, $request->file('profile_picture'));

        $this->attachOwnerToGroup($group);

        return redirect()->back()->with('success', 'Grup berhasil dibuat!');
    }

    public function groupChat($slug)
    {
        $group = Group::where('slug', $slug)->firstOrFail();

        return view('chat.groupchat', [
            'group' => $group,
            'title' => $group->name,
            'conversations' => auth()->user()->groups()->with('users')->get(),
        ]);
    }

    protected function validateGroup(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255|unique:groups,name',
            'description' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    }

    protected function createGroup(array $data, $profilePicture): Group
    {
        $group = new Group([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']) . '-' . Str::random(6),
            'description' => $data['description'] ?? null,
            'owner_id' => Auth::id(),
        ]);

        if ($profilePicture) {
            $group->profile_picture = $profilePicture->store('groups', 'public');
        }

        $group->save();

        return $group;
    }

    protected function attachOwnerToGroup(Group $group): void
    {
        $group->users()->attach(Auth::id(), [
            'role' => 'owner',
            'status' => 'accepted',
        ]);
    }
}

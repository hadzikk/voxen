<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'group_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->description = $request->description;
        $group->owner_id = Auth::id();

        if ($request->hasFile('group_picture')) {
            $file = $request->file('group_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $group->group_picture = 'images/' . $filename;
        }

        $group->save();

        return redirect()->route('groups.index')->with('success', 'Grup berhasil dibuat.');
    }
}

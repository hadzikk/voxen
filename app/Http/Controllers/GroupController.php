<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    /**
     * Menampilkan daftar grup milik dan yang diikuti user
     */
    public function index()
    {
        $user = Auth::user();

        $ownedGroups = Group::where('owner_id', $user->id)->get();
        $joinedGroups = $user->groups()->get();

        $groups = $ownedGroups->merge($joinedGroups)->unique('id')->values();

        $alreadyFriends = $user->allFriends()
            ->map(fn($friendship) =>
                $friendship->friend_id === $user->id ? $friendship->user : $friendship->friend
            );

        return view('groups.index', [
            'title'   => 'Groups',
            'groups'  => $groups,
            'friends' => $alreadyFriends,
        ]);
    }

    /**
     * Menyimpan grup baru, menautkan pembuat sebagai admin dan mengundang anggota
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:50'],
            'groupImage'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'description'    => ['nullable', 'string', 'max:255'],
            'invited_users'  => ['nullable', 'array'],
            'invited_users.*'=> ['exists:users,id'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            // Simpan gambar jika ada
            $profilePath = null;
            if ($request->hasFile('groupImage')) {
                $profilePath = $request->file('groupImage')->store('group_images', 'public');
            }

            // Simpan grup sementara tanpa slug
            $group = Group::create([
                'owner_id'    => Auth::id(),
                'name'        => $validated['name'],
                'groupImage' => $profilePath,
                'slug'        => 'temp',
                'description' => $validated['description'] ?? null,
            ]);

            // Debug untuk memastikan data benar

            // Buat slug unik pendek (nama-group-ABCDE)
            $shortSlug = Str::slug($validated['name']) . '-' . Str::upper(Str::random(5));
            $group->update([
                'slug' => $shortSlug,
            ]);

            // Tambahkan owner sebagai admin
            $group->users()->attach(Auth::id(), [
                'status' => 'accepted',
                'role'   => 'admin',
            ]);

            // Tambahkan anggota yang diinvite
            if (!empty($validated['invited_users'])) {
                foreach ($validated['invited_users'] as $userId) {
                    $group->users()->attach($userId, [
                        'status' => 'invited',
                        'role'   => 'member',
                    ]);
                }
            }
        });

        return redirect()
            ->route('groups.index')
            ->with('success', 'Group berhasil dibuat.');
    }
}

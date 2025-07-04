<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signIn() 
    {
        $title = 'Sign In';

        return view('auth.signin', [
            'title' => $title,
        ]);
    }

    public function signUp() 
    {
        $title = 'Sign Up';

        return view('auth.signup', [
            'title' => $title,
        ]);
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'username'   => 'required|string|max:30|unique:users,username',
            'firstname'  => 'required|string|max:50',
            'lastname'   => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
        ]);

        $user = User::create([
            'username'  => $validated['username'],
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
        ]);

        $registered = Auth::login($user);

        if ($registered) {
            return redirect('chat.index');
        }

        return view('chat.index', [
            'title' => 'Chat',
        ]);
    }

    public function verify(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->with('error', 'Incorrect username or password')
                        ->withInput(['username' => $credentials['username']]);
        }

        Auth::login($user);

        return redirect('/auth/signin')->with('success', 'Successful login! redirects to the chat page...');
    }

}

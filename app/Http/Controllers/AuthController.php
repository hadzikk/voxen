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
        return view('auth.sign-in', [
            'title' => 'Sign In',
        ]);
    }

    public function signUp()
    {
        return view('auth.sign-up', [
            'title' => 'Sign Up',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|string|max:30|unique:users,username',
            'firstname' => 'required|string|max:50',
            'lastname'  => 'required|string|max:50',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8',
        ]);

        $user = User::create([
            'username'  => $validated['username'],
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()
            ->route('chat.index')
            ->with('success', 'Registration successful! Welcome.');
    }

    public function verifyCredentials(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->with('error', 'Incorrect username or password.')
                ->withInput(['username' => $credentials['username']]);
        }

        return redirect()
            ->route('chat.index')
            ->with('success', 'Successful login! Welcome.');
    }
}

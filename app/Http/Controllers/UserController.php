<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tweet;

class UserController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended(route('tweets.index'))->with('success', 'Login successful');
        }

        return redirect()->route('login')->with('error', 'Login failed. Please check your credentials.');
    }


    public function registerForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    public function users($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $tweets = Tweet::where('user_id', $user->id)->latest()->get();

        return view('users.profile', compact('user', 'tweets'));
    }

    public function editUsersForm($username)
    {
        $user = User::where('username', $username)->first();
        return view('users.edit', ['user' => $user]);
    }

    public function editUsers(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('users.edit', $user->username)->with('success', 'Profile updated successfully.');
    }

    public function editPasswordForm($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('users.edit-password', compact('user'));
    }

    public function updatePassword(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.profile', ['username' => $user->username])->with('success', 'Password updated successfully.');
    }

    public function deleteUsers($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $user->delete();

        Auth::logout();

        return redirect()->route('index')->with('success', 'Account deleted successfully.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('index')->with('success', 'Logged out successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function index()
    {
        $tweets = Tweet::with('user')->latest()->paginate(10); // Eager load user relationship
        return view('tweets.index', compact('tweets'));
    }

    public function create()
    {
        return view('tweets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        $tweet = new Tweet();
        $tweet->user_id = auth()->user()->id;
        $tweet->content = $request->input('content');
        $tweet->save();

        return redirect()->route('tweets.create')->with('success', 'Tweet posted successfully!');
    }

    public function show(Tweet $tweet)
    {
        return view('tweets.show', compact('tweet'));
    }

    public function edit(Tweet $tweet)
    {
        return view('tweets.edit', compact('tweet'));
    }

    public function update(Request $request, Tweet $tweet)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        $tweet->content = $request->input('content');
        $tweet->save();

        return redirect()->route('tweets.index')->with('success', 'Tweet updated successfully!');
    }

    public function destroy(Tweet $tweet)
    {
        $tweet->delete();
        return redirect()->route('tweets.index')->with('success', 'Tweet deleted successfully!');
    }

}

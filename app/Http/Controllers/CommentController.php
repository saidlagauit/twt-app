<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Tweet;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Tweet $tweet)
    {
        $request->validate([
            'content' => 'required|max:255',
        ]);

        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->user()->id;

        $tweet->comments()->save($comment);

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }
    
    public function destroy(Tweet $tweet, Comment $comment)
    {
        if ($comment->user_id === auth()->user()->id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comment deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }
    }

}

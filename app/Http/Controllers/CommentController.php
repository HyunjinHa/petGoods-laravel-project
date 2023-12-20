<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'post_id' => 'required|exists:posts,id',
        'content' => 'required',
    ]);

    $comment = new Comment;
    $comment->user_id = Auth::id();
    $comment->post_id = $request->post_id;
    $comment->content = $request->content;
    $comment->save();

    return back();
}
}

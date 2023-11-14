<?php

namespace App\Http\Controllers;

use App\Comment;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function index(Video $video) {
        return $video->comment()->paginate(10);
    }

    public function show(Comment $comment) {
        return $comment->replies()->paginate(10);
    }

    public function store(Request $request, Video $video) {
       return User::find(auth()->user()->id)->comment()->create([
                'body' => $request->body,
                'video_id' => $video->id,
                'comment_id' => $request->comment_id
        ])->fresh();
    }
}

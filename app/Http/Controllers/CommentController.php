<?php

namespace App\Http\Controllers;

use App\Comment;
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
}

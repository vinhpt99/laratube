<?php

namespace App\Http\Controllers;

use App\Video;
use App\User;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    //
    public function vote(Video $video, $type) {
        return User::find(auth()->user()->id)->toggleVote($video, $type);
    }
}

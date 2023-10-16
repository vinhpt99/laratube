<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    //
    public function show(Video $video) {
        if(request()->wantsJson()) {
            return $video;
        } 
        return view('video', compact('video'));
    }
}

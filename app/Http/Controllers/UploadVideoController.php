<?php

namespace App\Http\Controllers;

use App\Chanel;

use Illuminate\Http\Request;
use App\Jobs\Videos\ConvertForStreaming;
use App\Jobs\Videos\CreateVideoThumbnail;

class UploadVideoController extends Controller
{
    //
    public function index(String $id) {
        $chanel = Chanel::find($id);
        return view('channels.upload', [
            'channel' => $chanel,
        ]);
    }

    public function store(String $id) {
        $chanel = Chanel::find($id);
        $video = $chanel->videos()->create([
            'title' => request()->title,
            'path'  => request()->video->store("channels/{$chanel->id}")
        ]);
        CreateVideoThumbnail::dispatch($video);
        ConvertForStreaming::dispatch($video);
        return $video;
     
    }
}

<?php

namespace App\Http\Controllers;

use App\Chanel;
use Illuminate\Http\Request;

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
        return $chanel->videos()->create([
            'title' => request()->title,
            'path'  => request()->video->store("channels/{$chanel->id}")
        ]);
    }
}

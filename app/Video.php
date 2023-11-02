<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Chanel;
use App\Vote;

class Video extends Model
{
    use HasFactory;
    public function channel() {
        return $this->belongsTo(Chanel::class, 'chanel_id');
    }

    public function editable() {
        return auth()->check() && $this->channel->user_id === auth()->user()->id;
    }

    public function votes() {
        return $this->morphMany(Vote::class, 'voteable');
    }

    public function comment() {
       
        return Comment::select('comments.*', 'users.name')
                        ->join('users', 'users.id', '=', 'comments.user_id')
                        ->where('comments.video_id', $this->id)
                        ->whereNull('comment_id');
       
    }
}

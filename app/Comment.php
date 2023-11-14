<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Vote;
class Comment extends Model
{
    use HasFactory;
    protected $width = ['user'];
    protected $appends = ['repliesCount', 'user', 'votes'];
    public function video() {
        return $this->belongsTo(Video::class);
    }

    public function getRepliesCountAttribute() {
        return $this->replies->count();
    }

    public function getUserAttribute() {
        return User::find($this->user_id);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies() {
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
        
    }

    public function getVotesAttribute() {
        return Vote::where("voteable_id", $this->id)->get();
    }

    public function votes() {
        return $this->morphMany(Vote::class, 'voteable');
    }


  
}

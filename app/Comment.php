<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $width = ['user'];
    protected $appends = ['repliesCount', 'user'];
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

  
}

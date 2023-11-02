<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vote extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'user_id'];
    public function voteable() {
        return $this->morphTo();
    }
}

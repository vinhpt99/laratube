<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chanel extends Model
{
    use HasFactory;
    public function user() {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();
        static::creating(
            function ($model) {
                $model->{$model->getKeyName()} = Str::uuid();
            }
        );
    }

    public function channel() {
        return $this->hasOne(Chanel::class);
    }

    public function comment() {
        return $this->hasMany(Comment::class);
    }

    public function toggleVote($entity, $type) {
        $vote = $entity->votes->where('user_id', $this->id)->first();
        
        if($vote) {
            $vote->update([
                'type' => $type
            ]);
            return $vote->refresh();
        } else {
          
            return $entity->votes()->create([
                'type' => $type,
                'user_id' => $this->id
            ]);
        }

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

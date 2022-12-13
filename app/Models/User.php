<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'privacy'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user has many tweets
    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    // user has many comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // user has many likes
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }


    public function isFollowing(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_user_id');
    }

    public function isFollowedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follow_user_id', 'user_id');
    }

    public function isFollowingUser($user_id)
    {
        return $this->isFollowing()->where('follow_user_id', $user_id)->exists();
    }

}

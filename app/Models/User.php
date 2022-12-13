<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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

    // user has many followers
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_user_id');
    }

    // user has many following
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_user_id');
    }

    public function isFollowing(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follow_user_id');
    }

    public function isFollowedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_user_id');
    }

}

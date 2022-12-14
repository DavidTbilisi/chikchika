<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $likes
 */

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
    ];

    // tweet belongs to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // tweet has many comments
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // tweet has many likes
    public function likes() : HasMany
    {
        return $this->hasMany(Like::class);
    }

    // is post liked by user
    public function isLikedBy($user_id) : bool
    {
        return $this->likes->where('user_id', $user_id)->count() > 0;
    }
}

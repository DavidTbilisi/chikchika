<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    use HasFactory;

    // tweet belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // tweet has many comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // tweet has many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


}

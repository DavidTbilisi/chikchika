<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // comment belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // comment belongs to tweet
    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    // comment has many likes
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // like belongs to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // like belongs to tweet
    public function tweet()
    {
        return $this->belongsTo(Tweet::class);
    }

    // like belongs to comment
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'tweet_id'];

    // like belongs to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // like belongs to tweet
    public function tweet()
    {
        return $this->belongsTo(Tweet::class, 'tweet_id', 'id');
    }

    // like belongs to comment
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'id');
    }

}

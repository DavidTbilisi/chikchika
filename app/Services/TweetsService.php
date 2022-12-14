<?php
namespace App\Services;

use App\Models\Tweet;
use App\Notifications\TweetCommented;
use App\Notifications\TweetLiked;
use Illuminate\Support\Facades\Notification;


class TweetsService
{
    public function getTweets($user_id)
    {

        // sql query to get tweets from
        // users that the current user follows
        // and the current user
        // and from public users
        $tweets = Tweet::where('user_id', $user_id)
            ->orWhereIn('user_id', function ($query) use ($user_id) {
                $query->select('follow_user_id')
                    ->from('follows')
                    ->where('user_id', $user_id);
            })
            ->orWhereIn('user_id',function($query) {
                $query->select('users.id')
                ->from('users')
                ->where('users.privacy', 'public');
            })
            ->with('user')
            ->with('likes')
            ->with('comments')
            ->orderBy('created_at', 'desc')
            ->get();
        return $tweets;
    }

    public function getTweetsByUser($user_id)
    {
        return Tweet::where('user_id', $user_id)
            ->with('user')
            ->with('likes')
            ->with('comments')
            ->get();
    }

    public function getTweet($tweet_id)
    {
        return Tweet::where('id', $tweet_id)
            ->with('user')
            ->with('likes')
            ->with('comments')
            ->first();
    }

    public function createTweet()
    {
        // validate tweet body
        $validated = request()->validate([
            'body' => 'required|max:144',
        ]);

        $tweet = Tweet::create([
            'user_id' => auth()->user()->id,
            'body' => $validated['body'],
        ]);

        return $tweet;
    }

    public function updateTweet($tweet_id, $tweet)
    {
        return Tweet::where('id', $tweet_id)
            ->update([
                'body' => $tweet
            ]);
    }

    public function deleteTweet($tweet_id)
    {
        return Tweet::where('id', $tweet_id)
            ->delete();
    }

    public function likeTweet($user_id, $tweet_id)
    {
        $tweet = Tweet::where('id', $tweet_id)
            ->first()
            ->likes()
            ->create([
                'user_id' => $user_id
            ]);

        Notification::send(auth()->user(), new TweetLiked($tweet, $user_id));

        return $tweet;
    }

    public function unlikeTweet($user_id, $tweet_id)
    {
        return Tweet::where('id', $tweet_id)
            ->first()
            ->likes()
            ->where('user_id', $user_id)
            ->delete();
    }

    public function commentTweet($user_id, $tweet_id, $comment)
    {
        $commented = Tweet::where('id', $tweet_id)
            ->first()
            ->comments()
            ->create([
                'user_id' => $user_id,
                'body' => $comment
            ]);

        Notification::send(auth()->user(), new TweetCommented( $user_id, $commented));
        return $commented;

    }

    public function deleteComment($comment_id, $tweet_id)
    {
        return Tweet::where('id', $tweet_id)
            ->first()
            ->comments()
            ->where('id', $comment_id)
            ->delete();
    }

    public function getComments($tweet_id)
    {
        return Tweet::where('id', $tweet_id)
            ->first()
            ->comments()
            ->with('user')
            ->get();
    }

    public function getLikes($tweet_id)
    {
        return Tweet::where('id', $tweet_id)
            ->first()
            ->likes()
            ->with('user')
            ->get();
    }




}

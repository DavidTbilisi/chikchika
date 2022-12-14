<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Tweet;
use App\Services\TweetsService;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    // create Tweet
    public function store(TweetsService $tweetsService)
    {
       $tweet = $tweetsService->createTweet();
        return response()->json($tweet, 201);
    }

    // fetch one tweet
    public function show(Tweet $tweet)
    {
        // get Tweet with comment and likes
        $tweet = Tweet::with(['comments', 'likes'])->find($tweet->id);
        return response()->json($tweet, 200);
    }

    // like tweet
    public function like(TweetsService $tweetsService, Tweet $tweet)
    {
        $user_id = auth()->user()->id;
        return response()->json($tweetsService->likeTweet( $user_id, $tweet->id), 201);
    }

    // unlike tweet
    public function unlike(TweetsService $tweetsService, Tweet $tweet)
    {
        $user_id = auth()->user()->id;
        return response()->json($tweetsService->unlikeTweet($user_id, $tweet->id), 201);
    }

    // get Tweet comments
    public function comments(Tweet $tweet)
    {
        $comments = Comment::where('tweet_id', $tweet->id)->get();
        return response()->json($comments, 200);
    }

    // comment on tweet
    public function comment(Request $request, Tweet $tweet)
    {
        // validate comment body
        $validated = $request->validate([
            'body' => 'required|max:144',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->tweet_id = $tweet->id;
        $comment->body = $validated['body'];
        $comment->save();

        return response()->json($comment, 201);
    }


    public function newsFeed(TweetsService $tweetsService)
    {
        $user_id = auth()->user()->id;
        return response()->json($tweetsService->getTweets($user_id), 200);
    }



}

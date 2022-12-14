<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Services\TweetsService;
use Illuminate\Http\Request;

class TweetController extends Controller
{


    public function create()
    {
        return view('tweets.create');
    }


    public function store(TweetsService $tweetsService)
    {
        $tweet = $tweetsService->createTweet();
        return redirect()->route('tweets.show', $tweet);
    }


    public function show(Tweet $tweet)
    {
        // get Tweet with comment and likes
        $tweet = Tweet::with(['comments', 'likes'])->find($tweet->id);
        return view("tweets.show", ["tweet" => $tweet]);
    }


    public function edit(Tweet $tweet)
    {
        //
    }


    public function update(Request $request, Tweet $tweet)
    {
        //
    }


    public function destroy(Tweet $tweet)
    {
        //
    }

    public function like(TweetsService $tweetsService, Tweet $tweet)
    {
        $user_id = auth()->user()->id;
        if ($tweet->isLikedBy($user_id)) {
            $tweetsService->unlikeTweet($user_id, $tweet->id );
        } else {
            $tweetsService->likeTweet($user_id, $tweet->id);
        }

        return redirect()->back();
    }

    public function comment(TweetsService $tweetsService, Tweet $tweet)
    {
        $user_id = auth()->user()->id;

        $validated = request()->validate([
            'body' => 'required|max:144',
        ]);
        $tweetsService->commentTweet($user_id, $tweet->id, $validated['body']);

        return redirect()->route('tweets.show', $tweet);
    }

}

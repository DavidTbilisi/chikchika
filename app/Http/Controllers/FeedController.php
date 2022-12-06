<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() :JsonResponse
    {

        // get logged in user id
        $user_id = auth()->user()->id;


        // get all tweets from users that the logged-in user is following
        $following_tweets = Tweet::whereIn('user_id', function($query) use ($user_id) {
            $query->select('follows.follow_user_id')
                ->from('follows')
                ->where('follows.user_id', $user_id);
        })->with('user')
            ->with('likes')
            ->with('comments')
            ->get();


        // get users where user privacy is public id
        $public_tweets = Tweet::where('user_id', function($query) {
            $query->select('users.id')
                ->from('users')
                ->where('users.privacy', 'public');
        })->with('user')
            ->with('likes')
            ->with('comments')
            ->get();


        return response()->json($following_tweets->merge($public_tweets));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $tweet = Tweet::where('id', $id)
            ->with('user')
            ->with('likes')
            ->with('comments')
            ->first();

        return response()->json($tweet);
    }

    public function replies($tweet_id) :JsonResponse
    {
        // TODO: get replies for a tweet
        $replies = Tweet::where('parent_id', $tweet_id)
            ->with('user')
            ->with('likes')
            ->with('comments')
            ->get();

        return response()->json($replies);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tweet $tweet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tweet $tweet)
    {
        //
    }
}

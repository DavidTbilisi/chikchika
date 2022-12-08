<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request) : JsonResponse
    {
        // validate tweet body
        $validated = $request->validate([
            'body' => 'required|max:144',
        ]);

        $tweet = new Tweet();
        $tweet->user_id = auth()->user()->id;
        $tweet->body = $validated['body'];
        $tweet->save();

        return response()->json($tweet, 201);
    }


    public function show(Tweet $tweet)
    {
        //
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
}

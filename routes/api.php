<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/*
GET /v1/me- returns current user details
GET /v1/me/following- returns the list of users youare following to
GET /v1/me/follows- returns the list of users youare followed by
GET /v1/tweets- returns the feed
POST /v1/tweets- creates a tweet
GET /v1/tweets/{tweet_id}- returns the single tweet
GET /v1/tweets/{tweet_id}/replies- returns the repliesmade on a single tweet
POST /v1/tweets/{tweet_id}/like- likes a tweet
DELETE /v1/tweets/{tweet_id}/unlike- unlikes a tweet
POST /v1/tweets/{tweet_id}/reply- replies to a tweet
*/


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::get('/me', function (Request $request) {
            return $request->user();
        });
        Route::get('/me/following', function (Request $request) {
            return $request->user()->following;
        });
        Route::get('/me/followers', function (Request $request) {
            return $request->user()->followers;
        });
        Route::get('/tweets', function (Request $request) {
            return $request->user()->timeline();
        });
        Route::post('/tweets', function (Request $request) {
            $request->validate([
                'body' => 'required|max:255'
            ]);
            return $request->user()->tweets()->create([
                'body' => $request->body
            ]);
        });
        Route::get('/tweets/{tweet}', function (Request $request, $tweet) {
            return $request->user()->tweets()->findOrFail($tweet);
        });
        Route::get('/tweets/{tweet}/replies', function (Request $request, $tweet) {
            return $request->user()->tweets()->findOrFail($tweet)->replies;
        });
        Route::post('/tweets/{tweet}/like', function (Request $request, $tweet) {
            return $request->user()->tweets()->findOrFail($tweet)->like();
        });
        Route::delete('/tweets/{tweet}/unlike', function (Request $request, $tweet) {
            return $request->user()->tweets()->findOrFail($tweet)->unlike();
        });
        Route::post('/tweets/{tweet}/reply', function (Request $request, $tweet) {
            $request->validate([
                'body' => 'required|max:255'
            ]);
            return $request->user()->tweets()->findOrFail($tweet)->replies()->create([
                'body' => $request->body
            ]);
        });
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

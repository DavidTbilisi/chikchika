<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
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
GET /v1/tweets/{tweet_id}/replies- returns the replies made on a single tweet
POST /v1/tweets/{tweet_id}/like- likes a tweet
DELETE /v1/tweets/{tweet_id}/unlike- unlikes a tweet
POST /v1/tweets/{tweet_id}/reply- replies to a tweet
*/


Route::group(['middleware' => ['auth:sanctum',"isAPI"]], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::get('/me', [ProfileController::class, 'me']);
        Route::get('/me/following', [ProfileController::class, 'following']);
        Route::get('/me/followers', [ProfileController::class, 'followers']);
        Route::get('/tweets', [FeedController::class, 'index']);
        Route::get('/tweets/{tweet}', [FeedController::class, 'show']);
        Route::get('/tweets/{tweet}/replies', [FeedController::class, 'replies']);

        // TODO:: ღიირს კი ერთი მეთოდისთვის კონტროლერის შექმნა?
        Route::post('/tweets', [TweetController::class, 'store']);

        Route::post('/tweets/{tweet}/reply', [FeedController::class, 'reply']);
        Route::post('/tweets/{tweet}/like', [FeedController::class, 'like']);

        Route::delete('/tweets/{tweet}/unlike', [FeedController::class, 'unlike']);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

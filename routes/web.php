<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::prefix('usr')->name('profile.')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
        // user follow/unfollow
        Route::post('/{username}/follow', [ProfileController::class, 'follow'])->name('follow')->where("username","[a-zA-Z0-9]+");
        Route::post('/{username}/unfollow', [ProfileController::class, 'unfollow'])->name('unfollow')->where("username","[a-zA-Z0-9]+");
        // followers/following
        Route::get('/{username}/followers', [ProfileController::class, 'followers'])->name('followers')->where("username","[a-zA-Z0-9]+");
        Route::get('/{username}/following', [ProfileController::class, 'following'])->name('following')->where("username","[a-zA-Z0-9]+");
        Route::get('/dashboard', [FeedController::class, 'dashboard'])->name('dashboard');
    });

    // tweets route group
    Route::group(['prefix' => 'tweets'], function () {
        Route::name("tweets.")->group(function () {

            Route::get('/home', [TweetController::class, 'index'])->name('index');
            Route::get('/create', [TweetController::class, 'create'])->name('create');
            Route::post('/save', [TweetController::class, 'store'])->name('store');

            Route::get('/{tweet}/edit', [TweetController::class, 'edit'])->name('edit');
            Route::post('/{tweet}/like', [TweetController::class, 'like'])->name('like')->where("tweet","[0-9]+");
            Route::post('/{tweet}/comment', [TweetController::class, 'comment'])->name('comment')->where("tweet","[0-9]+");

            Route::patch('/{tweet}', [TweetController::class, 'update'])->name('update')->where("tweet","[0-9]+");
            Route::delete('/{tweet}', [TweetController::class, 'destroy'])->name('destroy')->where("tweet","[0-9]+");
            Route::get('/{tweet}', [TweetController::class, 'show'])->name('show')->where("tweet","[0-9]+");
        });
    });


    Route::get('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    })->name('tokens.create');


});


require __DIR__.'/auth.php';

Route::get("/{username}",[ProfileController::class,"show"])
    ->name("username")
    ->where("username","[a-zA-Z0-9]+")
    ->middleware(["auth","verified"]);

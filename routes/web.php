<?php

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

Route::get('/dashboard', function () {
    $user_id = auth()->user()->id;
    return view('dashboard',["tweets"=>(new App\Services\TweetsService)->getTweets($user_id)] );
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // tweets route group
    Route::group(['prefix' => 'tweets'], function () {
        Route::name("tweets.")->group(function () {
            Route::get('/', [TweetController::class, 'index'])->name('index');
            Route::get('/create', [TweetController::class, 'create'])->name('create');
            Route::post('/', [TweetController::class, 'store'])->name('store');
            Route::get('/{tweet}', [TweetController::class, 'show'])->name('show');
            Route::get('/{tweet}/edit', [TweetController::class, 'edit'])->name('edit');
            Route::patch('/{tweet}', [TweetController::class, 'update'])->name('update');
            Route::delete('/{tweet}', [TweetController::class, 'destroy'])->name('destroy');
            // like and unlike
            Route::post('/{tweet}/like', [TweetController::class, 'like'])->name('like');
            // comment
            Route::post('/{tweet}/comment', [TweetController::class, 'comment'])->name('comment');
        });
    });

    Route::get('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
        return ['token' => $token->plainTextToken];
    })->name('tokens.create');



});

require __DIR__.'/auth.php';

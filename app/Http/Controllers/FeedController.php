<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use App\Services\TweetsService;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FeedController extends Controller
{

    public function dashboard(TweetsService $tweetsService): View
    {
        $tweets = $tweetsService->getTweets(Auth()->user()->id);
        return view('dashboard', compact('tweets'));
    }

}

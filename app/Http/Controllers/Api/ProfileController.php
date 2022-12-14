<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // show profile/me
    public function me( Request $request )
    {
        return response()->json( $request->user(), 200 );
    }
    // user is following
    public function following(Request $request)
    {
        return response()->json($request->user()->isFollowing()->get());
    }
    // user follows
    public function followers( Request $request )
    {
        return response()->json( $request->user()->isFollowedBy()->get(), 200 );
    }
}

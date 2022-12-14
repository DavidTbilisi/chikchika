<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Notifications\UserFollowed;
use App\Notifications\UserUnfollowed;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{


    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }


    public function update(ProfileUpdateRequest $request)
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function following( UserService $user, $username )
    {
        $user = $user->getUserByUsername($username);
        $following = $user->isFollowing()->get();
        return view('profile.follow', compact('user', 'following'));

    }

    public function followers( UserService $user, $username)
    {
        $user = $user->getUserByUsername($username);
        $followers = $user->isFollowedBy()->get();
        return view('profile.follow', compact('user', 'followers'));
    }

    // TODO: Code bellow should be moved to service
    public function show( $name )
    {
        $user = User::where( 'name', $name )
            ->with(['tweets', 'isFollowing', 'isFollowedBy', 'likes', 'comments'])
            ->first();
        return view( 'profile.show', ['user' => $user] );
    }


    // follow user
    public function follow( Request $request, $name )
    {
        $user = User::where( 'name', $name )->first();
        $request->user()->isFollowing()->attach( $user );

        Notification::send($user, new UserFollowed($request->user()));

        return redirect()->back();
    }

    // unfollow user
    public function unfollow( Request $request, $name )
    {
        $user = User::where( 'name', $name )->first();
        $request->user()->isFollowing()->detach( $user->id );
        Notification::send($user, new UserUnfollowed($request->user()));

        return redirect()->back();
    }

    // notifications
    public function notifications( Request $request )
    {
        $user = $request->user();
        return view( 'profile.notifications', compact( 'user' ) );
    }
}


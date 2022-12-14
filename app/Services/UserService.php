<?php

namespace App\Services;

use App\Models\Following;
use App\Models\User;

class UserService
{
    // follow a user
    public function followUser($user_id, $follow_user_id)
    {
        return Following::create([
            'user_id' => $user_id,
            'follow_user_id' => $follow_user_id
        ]);
    }

    // unfollow a user
    public function unfollowUser($user_id, $follow_user_id)
    {
        return Following::where('user_id', $user_id)
            ->where('follow_user_id', $follow_user_id)
            ->delete();
    }

    public function getUserByUsername($username)
    {
        return User::where('name', $username)->firstOrFail();
    }




}

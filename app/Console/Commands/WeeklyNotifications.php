<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\WeeklyNotification;
use Illuminate\Console\Command;

class WeeklyNotifications extends Command
{

    protected $signature = 'notify:users';

    protected $description = 'Send weekly notifications to users';


    public function handle()
    {

        $users = User::all();

        foreach ($users as $user) {
            // get aggregated information about user's likes, comments, followers, following
            $weeklies = $user->withCount(['likes', 'comments', 'isFollowing', 'isFollowedBy'])
                ->where('id', $user->id)
                ->where('created_at', '>=', now()->subDays(7))  // get users created in the last 7 days)
                ->get();

            $user->notify(new WeeklyNotification($weeklies));
        }


        // and send it to the user
        $this->info('Weekly notifications sent to users');


        return Command::SUCCESS;
    }
}

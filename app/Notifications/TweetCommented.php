<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TweetCommented extends Notification
{
    use Queueable;


    public function __construct($user_id, $tweet)
    {
        $this->user_id = $user_id;
        $this->tweet = $tweet;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        $user = User::find($this->user_id);

        return [
            'user' => $user->toArray(),
            'tweet' => $this->tweet->toArray(),
            'message' => 'has commented on your tweet',
        ];
    }
}

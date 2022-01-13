<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;


class NewSubscribtion extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $auth_user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $auth_user)
    {
        $this->user = $user;
        $this->auth_user = $auth_user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'user_name' => $this->auth_user->name,
            'user_email' => $this->auth_user->email,
            'user_image' => $this->auth_user->image
        ];
    }

    public function toBroadcast($notifiable)
{
    return new BroadcastMessage([
        'data' => [
            'user_name' => $this->auth_user->name,
            'user_email' => $this->auth_user->email,
            'user_image' => $this->auth_user->image
        ]
    ]);
}

    // public function toDatabase($notifiable)
    // {
    //     return [

    //     ];
    // }
}

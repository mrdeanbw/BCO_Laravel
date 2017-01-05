<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TrialEnding extends Notification
{
    use Queueable;

    private $days_left;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($days_left)
    {
        $this->days_left = $days_left;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your BCO Power Trial is expiring')
                    ->line('We have noticed your trial will expire in '. $this->days_left.' day(s) and wanted to give you a heads up.')
                    ->line('Should you wish to convert your subscription into one of our great plans now, click the button')
                    ->line('After your trial ends you will no longer be able to use the services on our website.')
                    ->action('Convert into Full Subscription', url('/subscriptions/choose'))
                    ->line('Thank you for using BCO Power!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

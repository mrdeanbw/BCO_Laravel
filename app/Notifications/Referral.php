<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Referral extends Notification
{
    use Queueable;
    public $referral;
    public $referred_by;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Referral $referral, $referred_by)
    {
        //
        $this->referral = $referral;
        $this->referred_by = $referred_by;
        
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
                    ->line('Your colleague or business partner '. $this->referred_by->name . ' (' . $this->referred_by->email . ') has referred you to BCO Power with the following message:')
                    ->line('"'.$notifiable->message.'"')
                    ->line('BCO Shippers Association is a non-profit 501(c)3 organization that provides buying power in transportation services and technology offerings through its membership portal, BCO POWER.')
                    ->line('BCO Shippers Association (BCO) offers membership to importers and exporters of various products through volume buying power of transportation services such as parcel, less than truckload, drayage, air, and ocean. The members also receive technology benefits through the membership portal.')
                    ->action('Find out more about BCO Power here', url('/'))
                    ->line('We look forward to welcoming you as a subscriber!')
                    ->subject('You have been referred by '. $this->referred_by->name);
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

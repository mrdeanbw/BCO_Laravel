<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MemberMessage extends Notification
{
    use Queueable;
    private $subject;
    private $body;
    private $from;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($from, $subject, $body)
    {
        //
        $this->subject = $subject;
        $this->from = $from;
        $this->body = $body;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
         $vias = ['database'];

        $settings = $notifiable->privacy_settings;
        
        if($settings->message_email) {
            array_push($vias, 'mail');
        }
        
        return $vias;
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
                    ->subject('New message: '. $this->subject. ' from ' . $this->from->name)
                    ->line('You have received a new member message from '. $this->from->name . ':')
                    ->line(strip_tags($this->body))
                    ->action('Go to my Inbox', url('/users/inbox/'.$notifiable->id))
                    ->line('Thank you for using our application!');
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
            'from_name' => $this->from->name.' at '.$this->from->organization,
            'subject' => $this->subject,
            'body' => $this->body,
            'url' => '/users/compose/'.$notifiable->id.'/'.$this->from->id
        ];
    }
}

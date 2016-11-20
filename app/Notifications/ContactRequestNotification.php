<?php

namespace App\Notifications;

use App\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactRequestNotification extends Notification
{
    use Queueable;


    private $contact_request;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contact_request)
    {
        //
        $this->contact_request = $contact_request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject('New BCOPower Contact Request from '.$this->contact_request->name)
                    ->line('New BCOPower Contact Request from '.$this->contact_request->name)
                    ->line('Name: '.$this->contact_request->name)
                    ->line('Email: '.$this->contact_request->email)
                    ->line('Organization: '.$this->contact_request->organization)
                    ->line('Enquiry: '.$this->contact_request->enquiry);
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
            'subject' => 'New BCOPower Contact Request from '.$this->contact_request->name,
            'url' => '/contact-us',
            'from_name' => $this->contact_request->name.' ['.$this->contact_request->email.']',
            'body' => 'Organization: '.$this->contact_request->organization.'\nEnquiry: '.$this->contact_request->enquiry
        ];
    }
}

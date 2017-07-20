<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
class ExFreightUserNotification extends Notification
{
    use Queueable;

    private $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $intro_line = '<strong>Email:</strong> '.$this->user->email.'<br>';
        $intro_line = $intro_line.'<strong>Name:</strong> '.$this->user->name.'<br>';
        $intro_line = $intro_line.'<strong>Organization:</strong> '.$this->user->organization.'<br>';
        $intro_line = $intro_line.'<strong>Location:</strong> '.$this->user->city.', '.$this->user->state.', '.$this->user->country;
        
        $cc_line = '';
        if ($this->user->do_vendor_cc) {
            $cc_line = 'This member has agreed to a credit check and provided the following details:<br>';
            $cc_line = $cc_line.'<strong>Business Legal Name:</strong> '.$this->user->business_legal_name.'<br>';
            $cc_line = $cc_line.'<strong>Additional Address:</strong> '.$this->user->street.', Zip: '.$this->user->postal_code.'<br>';
            $cc_line = $cc_line.'<strong>Tax ID/VAT #:</strong> '.$this->user->tax_id;
        } else {
            $cc_line = 'This member has <strong>not</strong> opted in to the credit program and denied authorization for a credit check.';
        }
        return (new MailMessage)
                    ->subject('BCO Power Activation Request')
                    ->line('BCO Power kindly requests that the following user be assigned an username and API token so they can quote and book through the API.')
                    ->line($intro_line)
                    ->line($cc_line)
                    ->line('Thank you in advance!');
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

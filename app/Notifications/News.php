<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class News extends Notification
{
    use Queueable;

    private $newsItem;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($newsItem)
    {
        //
        $this->newsItem = $newsItem;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {   
        $vias = [];

        $settings = $notifiable->privacy_settings;
        if($settings->news_dm) {
            array_push($vias, 'database');
        }
        if($settings->news_email) {
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
                    ->subject('BCOPower News: '. $this->newsItem->title)
                    ->greeting("Hi, we've posted a new article that you might enjoy.")
                    ->line($this->newsItem->summary)
                    ->action('Go to the news article', url('/members/news/'.$this->newsItem->id))
                    ->line('Thank you for using BCOPower!');
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
            'subject' => $this->newsItem->title,
            'url' => 'members/news/'.$this->newsItem->id,
            'from_name' => env('APP_NAME') . ' News',
            'body' => $this->newsItem->summary
        ];
    }
}

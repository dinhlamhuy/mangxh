<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class thongbao extends Notification
{
    use Queueable;
    private $enrollmentData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        //
        $this->name=$name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

  
    public function toArray($notifiable)
    {
        return [
            'user_id'   =>  $this->name['id'],
            
        ];
    }
}

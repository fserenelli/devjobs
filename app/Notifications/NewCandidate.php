<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCandidate extends Notification
{
    use Queueable;

    public $id_vacant;
    public $vacant_name;
    public $user_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($id_vacant, $vacant_name, $user_id)
    {
        $this->id_vacant = $id_vacant;
        $this->vacant_name = $vacant_name;
        $this->user_id = $user_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/notifications');

        return (new MailMessage)
                    ->line('New candidate tu your vacant: ' . $this->vacant_name)
                    ->action('Show notification', $url);
    }

    /**
     * 
     */
    public function toDatabase(object $notifiable)
    {
        return [
            'id_vacant' => $this->id_vacant,
            'vacant_name' => $this->vacant_name,
            'user_id' => $this->user_id
        ];
    }
}

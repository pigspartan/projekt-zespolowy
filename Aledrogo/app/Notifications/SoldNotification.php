<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SoldNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    public $listingTitle;

    /**
     * Create a new notification instance.
     */
    public function __construct($listingTitle)
    {
        $this->listingTitle = $listingTitle;
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
        return (new MailMessage)
            ->subject('Item sold')
            ->line('Someone bought an item You listed: ' . $this->listingTitle)
            ->action('Check Your transactions for more details', url('/transactions/' . $notifiable->id))
            ->line('You can also payout Your funds.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => $this->listingTitle,
            'url' => url('/transactions/' . $notifiable->id),
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'listingTitle' => $this->listingTitle,
        ];
    }
}

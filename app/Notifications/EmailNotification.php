<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailNotification extends Notification
{
    use Queueable;
    private $dataUser;

    /**
     * Create a new notification instance.
     */
    public function __construct($dataUser)
    {
        $this->dataUser = $dataUser;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->priority(1)
            ->greeting('Halo, ' . $this->dataUser['name'])
            ->subject('Reset Kata Sandi')
            ->line('Jika Anda menerima email ini, berarti Anda sedang berusaha untuk mengganti kata sandi akun Anda.')
            ->line('Jangan bagikan token ini kepada siapa pun.')
            ->line('Token: ' . $this->dataUser['token'])
            ->line('Abaikan jika Anda merasa tidak melakukan aksi ini.')
            ->salutation('Terima kasih.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

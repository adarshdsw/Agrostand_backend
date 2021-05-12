<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\Driver;
use App\Models\DriverTracking;
use App\Models\Ebill;

class NotifySenderDriverRegistration extends Notification
{
    use Queueable;

    private $driver = '';
    private $user_name = '';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
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

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('%s: Driver Registration Message!', config('app.name'));
        $greeting = sprintf('Hello %s!', $notifiable->name);

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->salutation('Yours Faithfully')
                    ->line('Your Driver '.$this->driver->name.' is successfully register in an Agrostand System.')
                    ->line('Your Driver login Credentials are -')
                    ->line('username - '. $this->driver->mobile)
                    ->line('password - '. $this->driver->conf_password);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => __('messages.notification.driver_registration.title'),
            'body' => __('messages.notification.driver_registration.body'),
            'url' => '/'
        ];
    }
}

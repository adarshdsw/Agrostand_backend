<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Ebill;

class SendEmailOtpToUser extends Notification
{
    use Queueable;
    public $fromUser;
    public $ebill;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ebill $ebill = null)
    {
        // $this->fromUser = $user;
        $this->ebill = $ebill;
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
        $subject = sprintf('%s: OTP Received!', config('app.name'));
        $greeting = sprintf('Hello %s!', $notifiable->name);
        $title = __('messages.notification.send_otp.title');
        $body = __('messages.notification.send_otp.body', ['user_otp'=>$this->ebill->pickup_otp, 'orde_id'=>$this->ebill->order_id]);

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->salutation('Yours Faithfully')
                    ->line($title)
                    ->line($body);
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
            'title' => __('messages.notification.send_otp.title'),
            'body' => __('messages.notification.send_otp.body', ['user_otp'=>$this->ebill->pickup_otp, 'orde_id'=>$this->ebill->order_id]),
            'url' => '/'
        ];
    }
}

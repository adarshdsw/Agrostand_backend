<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Ebill;

class NotifyPaymentProcessAdmin extends Notification
{
    use Queueable;

    private $vendor;
    private $ebill;
    private $ebill_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ebill $ebill)
    {
        $this->vendor = User::find($ebill->vendor_id);
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
        $subject = sprintf('%s: Ebill Payment Processed!', config('app.name'));
        $greeting = sprintf('Hello %s!', $notifiable->name);
        $title = __('messages.notification.payment_process_admin.title', ['user'=>$this->vendor->name]);
        $body = __('messages.notification.payment_process_admin.body');

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->salutation('Yours Faithfully')
                    ->line($title)
                    ->line($body)
                    ->attach(public_path('/uploads/ebill_pdf/'.$this->ebill_name), [
                        'as' => $this->ebill_name,
                        'mime' => 'text/pdf',
                    ]);
                    // ->action('Notification Action', url('/'))
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
            'title' => __('messages.notification.payment_process_admin.title', ['user'=>$this->vendor->name]),
            'body' => __('messages.notification.payment_process_admin.body'),
            'url' => '/'
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Ebill;

class NotifyAdminAgroService extends Notification
{
    use Queueable;

    public $sender;
    public $ebill;
    public $ebill_pdf;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ebill $ebill)
    {
        $sender = User::find($ebill->user_id);
        if(!empty($sender)){
            $this->sender = $sender;
        }
        $this->ebill = $ebill;
        $ebill_pdf_arr  =  explode('ebill_pdf', $ebill->ebill_pdf);
        $this->ebill_pdf = str_replace('/', '', $ebill_pdf_arr[1]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return ['mail', 'database'];
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
        $subject = sprintf('%s: Ebill Shipping Type : AgroService!', config('app.name'));
        $greeting = sprintf('Hello %s!', $notifiable->name);
        $title = __('messages.notification.agro_service.title');
        $body = __('messages.notification.agro_service.body', ['user'=>$this->sender->name]);

        return (new MailMessage)
                    ->subject($subject)
                    ->greeting($greeting)
                    ->salutation('Yours Faithfully')
                    ->line($title)
                    ->line($body)
                    ->attach(public_path('/uploads/ebill_pdf/'.$this->ebill_pdf), [
                        'as' => $this->ebill_pdf,
                        'mime' => 'text/pdf',
                    ]);
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
            'title' => __('messages.notification.agro_service.title'),
            'body' => __('messages.notification.agro_service.body'),
            'url' => '/'
        ];
    }
}

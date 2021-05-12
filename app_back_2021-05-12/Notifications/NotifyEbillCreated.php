<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

use App\Models\User;
use App\Models\Ebill;

class NotifyEbillCreated extends Notification
{
    use Queueable;

    public $sender;
    public $ebill;
    public $ebill_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $sender = null, Ebill $ebill = null)
    {
        $this->sender = $sender;
        $this->ebill = $ebill;
        $ebill_pdf_arr =  explode('ebill_pdf', $ebill->ebill_pdf);
        $this->ebill_name = str_replace('/', '', $ebill_pdf_arr[1]);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // return [FcmChannel::class];
        // return ['mail', 'database', FcmChannel::class];
        return ['database', FcmChannel::class];
    }

    public function toFcm($notifiable)
    {
        $title = __('messages.notification.ebill.title');
        $body = __('messages.notification.ebill.body', ['user'=>$this->sender->name]);
        $custom_data = json_encode(['ebill_id' => $this->ebill->id, 'case' => 'ebill_create']);
        
        return FcmMessage::create()
            ->setData(['data'=>$custom_data])
            ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
                ->setTitle($title)
                ->setBody($body)
                // ->setImage('http://192.168.0.131:8000/uploads/user_image/05-Mar-2021_user_img_1614920313223914208.jpg')
            )
            ->setAndroid(
                AndroidConfig::create()
                    ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
                    ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
            )->setApns(
                ApnsConfig::create()
                    ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    }

    // optional method when using kreait/laravel-firebase:^3.0, this method can be omitted, defaults to the default project
    public function fcmProject($notifiable, $message)
    {
        // $message is what is returned by `toFcm`
        return 'app'; // name of the firebase project to use
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf('%s: Ebill Created!', config('app.name'));
        $greeting = sprintf('Hello %s!', $notifiable->name);
        $title = __('messages.notification.ebill.title');
        $body = __('messages.notification.ebill.body', ['user'=>$this->sender->name]);

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
            'title' => __('messages.notification.welcome.title'),
            'body' => __('messages.notification.welcome.body'),
            'url' => '/'
        ];
    }
}

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

class SenderNotifyPaymentStatusReceiver extends Notification
{
    use Queueable;

    private $user;
    private $ebill;
    private $ebill_name;
    private $payment_status_str;
    private $payment_status = [
        ['key'=>0, 'value'=>'pending', 'color'=>'warning'],
        ['key'=>1, 'value'=>'success', 'color'=>'success'],
        ['key'=>2, 'value'=>'processed by receiver', 'color'=>'primary'],
        ['key'=>3, 'value'=>'hold by admin', 'color'=>'primary'],
        ['key'=>4, 'value'=>'accept by admin', 'color'=>'success'],
        ['key'=>5, 'value'=>'decline by admin', 'color'=>'danger'],
        ['key'=>6, 'value'=>'processed by admin', 'color'=>'primary'],
        ['key'=>7, 'value'=>'cancel by sender', 'color'=>'danger'],
        ['key'=>8, 'value'=>'cancel by receiver', 'color'=>'danger'],
    ];

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Ebill $ebill)
    {
        foreach($this->payment_status as $pstatus){
            if($pstatus['key'] == $ebill->payment_status){
                $this->payment_status_str = $pstatus['value'];
            }

        }
        $this->user = User::find($ebill->user_id);
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
        return ['database', FcmChannel::class];
    }

    public function toFcm($notifiable)
    {
        $title = __('messages.notification.sender_payment_status.title', ['sender_user'=>$this->user->name, 'payment_status'=> $this->payment_status_str]);
        $body = __('messages.notification.sender_payment_status.body', ['sender_user'=>$this->user->name, 'payment_status'=> $this->payment_status_str]);
        $custom_data = json_encode(['ebill_id' => $this->ebill->id, 'case' => 'sender_payment_update', 'user_type'=>'receiver']);
        
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
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'title' => __('messages.notification.sender_payment_status.title', ['sender_user'=>$this->user->name, 'payment_status'=> $this->payment_status_str]),
            'body' => __('messages.notification.sender_payment_status.body', ['sender_user'=>$this->user->name, 'payment_status'=> $this->payment_status_str]),
            'url' => '/',
            'custom_data' => ['ebill_id' => $this->ebill->id, 'case' => 'sender_payment_update', 'user_type'=>'receiver'],
        ];
    }
}

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
use App\Models\Post;
use App\Models\PostLike;

class UserLikePost extends Notification
{
    use Queueable;

    private $post_like;
    private $post_title = '';
    private $user_name = '';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(PostLike $post_like)
    {
        $this->post_like = $post_like;
        $post = Post::find($post_like->post_id);
        if(!empty($post)){
            $this->post_title = ($post->title) ? $post->title : '';
        }
        $user = User::find($post_like->user_id);
        if(!empty($user)){
            $this->user_name = ($user->name) ? $user->name : '';
        }
        // dd($this->user_name, $this->post_title);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database',FcmChannel::class];
    }

    public function toFcm($notifiable)
    {
        $title  = __('messages.notification.post_like.title', [ 'user' => $this->user_name]);
        $body   = $this->post_title;
        $custom_data = json_encode(['post_id' => $this->post_like->post_id, 'case' => 'post_like']);
        // echo "<pre>";print_r($custom_data);die; 
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
            'title' => __('messages.notification.post_like.title'),
            'body' => __('messages.notification.post_like.body'),
            'url' => '/'
        ];
    }
}

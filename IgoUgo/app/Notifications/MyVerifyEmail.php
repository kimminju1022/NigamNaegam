<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class MyVerifyEmail extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        // if (static::$toMailCallback) {
        //     return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        // }

        return (new MailMessage)
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');

                    ->subject('이메일 인증을 완료해 주세요!')
                    ->greeting('안녕하세요!')
                    ->line('이메일 인증을 완료하려면 아래 버튼을 클릭하세요.')
                    ->action('이메일 인증하기', $url)
                    ->line('인증 후 서비스를 정상적으로 이용하실 수 있습니다.');
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify', // 이메일 인증 링크가 유효한지 검사하는 컨트롤러의 라우트 이름
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)), // auth.php에 값이 있으면 그 값 이용, 없으면 60분 세팅
            ['id' => $notifiable->getKey()] // 이건 사용자 id
        );    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications\channels;


use Ghasedak\Laravel\GhasedakFacade;
use Illuminate\Notifications\Notification;

class QasedakVerifySms
{
    public function send($notifiable, Notification $notification)
    {
        try {
            $template = env('GHASEDAK_TEMPLATE_PHONEVERIFY');
            $param1=$notifiable->code;
            $receptor = $notifiable->phone_number;
            $type=GhasedakFacade::VERIFY_MESSAGE_TEXT;
            $response = GhasedakFacade::setVerifyType($type)->Verify($receptor,$template,$param1);
        } catch (\Ghasedak\Exceptions\ApiException $e) {
            throw $e;
        } catch (\Ghasedak\Exceptions\HttpException $e) {
            throw $e;
        }
    }
}

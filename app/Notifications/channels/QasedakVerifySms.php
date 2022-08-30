<?php

namespace App\Notifications\channels;


use Illuminate\Notifications\Notification;

class QasedakVerifySms
{
    public function send($notifiable, Notification $notification)
    {
        try {
            $template = "cryptologiVerify";
            $param1=$notifiable->code;
            $receptor = $notifiable->phone_number;
            $type=1;
            $api = new \Ghasedak\GhasedakApi(config('services.qasedak.key'));
            $api->Verify($receptor,$type,$template,$param1);
        } catch (\Ghasedak\Exceptions\ApiException $e) {
            throw $e;
        } catch (\Ghasedak\Exceptions\HttpException $e) {
            throw $e;
        }
    }
}

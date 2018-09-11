<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 10/19/2017
 * Time: 11:46 AM
 */


namespace App\Channels;


use App\Api\ApiCredential;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use SmsPro;


class MtnSmsProChannel
{


    /**
     * Send given notification
     *
     * @param $notifiable
     * @param Notification $notfication
     *
     * @return void
     */

    public function send($notifiable, Notification $notification)
    {


        $sms = $notification->toSmsPro($notifiable);

        SmsPro::send($sms, new ApiCredential([
            'customer_id' => config('smspro.customer_id'),
            'username' => config('smspro.username'),
            'password' => config('smspro.password'),
            'originator' => config('smspro.originator2')
        ]));


    }


}
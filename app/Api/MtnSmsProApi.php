<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 10/17/2017
 * Time: 2:55 PM
 */


namespace App\Api;

use App\Channels\Message\Sms;
use GuzzleHttp\Client as Client;


class MtnSmsProApi
{


    // Constants

    const AUTHENTICATED_REQ = "HTTP_Authenticate?";

    const SEND_SMS_REQ = "HTTP_SendSms?";

    const SMS_STATUS_REQ = "HTTP_GetSmsStatus?";

    const TYPE_L = "Latin";

    const TYPE_AWAN = "ArabicWithArabicNumbers";

    const TYPE_AWN = "ArabicWithLatinNumbers";

    const BASE_URL = "http://smspro.mtn.ci/smspro/soap/messenger.asmx/";


    /**
     * Check user credentials
     *
     * @param ApiCredential|null $credential
     *
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public static function auth ( ApiCredential $credential = null)
    {


        $authClient = new Client([

            'timeout' => 2.0,

        ]);

        $response = $authClient->request('GET', self::buildAuthUrl($credential), [


            'headers' => [

                'Content-Type' => 'application/x-www-form-urlencoded',

            ]


        ] );

        $xml = simplexml_load_string( $response->getBody()->getContents() );

        if ( ( (string) $xml->Result )  === 'OK' )

            return true;

        else

            return false;


    }

    static function buildAuthUrl(ApiCredential $credential = null)
    {


        if ($credential)

            return self::BASE_URL . self::AUTHENTICATED_REQ . 'customerID=' . $credential->getCustomerId() .
                '&username=' . $credential->getUsername() . '&userPassword=' . $credential->getPassword();

        else

            return self::BASE_URL . self::AUTHENTICATED_REQ . 'customerID=' . config('smspro.customer_id') .
                '&username=' . config('smspro.username') . '&userPassword=' . config('smspro.password');


    }

    /**
     * Send SMS to given $recipients.
     *
     * Multiple recipients must be separated by semi-colon
     *
     * @param Sms $sms Message to send
     *
     * @param ApiCredential|null $credential Custom credential to use
     *
     * @param \Closure|null $success Closure to be executed on success
     *
     * @param \Closure|null $rejection Closure to be executed on rejection
     *
     * @return bool
     *
     * @internal param string $smsText
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public static function send( Sms $sms, ApiCredential $credential = null)
    {

        if (!$sms) return false;

        $client = new Client([

            'timeout' => 2.0,

        ]);

        /*
         * If there are multiple recipients we use bulk
         *
         * sending otherwise single sending
         *
         */

        if ( count( $recipients = explode(';',$sms->getRecipients() ) ) > 0 )
        {


            // Flag for message sending state

            $messageSuccessfullySent = false;

            // Bulk sending

            foreach ($recipients as $recipient)
            {


                if ( ! empty($recipient) )
                {


                    $response = $client->request( 'GET', self::buildSendUrl( $credential, $sms->getBody(),
                        $recipient, $sms->getOriginator() ) );

                    $messageSuccessfullySent = self::isRequestSuccessful($response);


                }


            }

            return $messageSuccessfullySent;


        }
        else
        {


            //dd($sms->getRecipients());
            // Single sending

            $response = $client->request('GET', self::buildSendUrl($credential, $sms->getBody(),
                $sms->getRecipients(), $sms->getOriginator() ) );

            return self::isRequestSuccessful($response);


        }




    }

    /**
     * @param $credentials
     * @param $smsText
     * @param $recipient
     * @param $originator
     *
     * @return string
     *
     */

    static function buildSendUrl(ApiCredential $credentials, string $smsText, $recipient, $originator)
    {


        if ($credentials !== null)
            return self::BASE_URL . self::SEND_SMS_REQ . 'customerID=' . $credentials->getCustomerId() .
                '&userName=' . $credentials->getUsername() . '&userPassword=' . $credentials->getPassword() . '&originator=' . $credentials->getOriginator() .
                '&messageType=' . self::TYPE_L . '&defDate=' . '&blink=false' . '&flash=false' . '&private=true'
                . '&smsText=' . $smsText . '&recipientPhone=' . $recipient ;


        else

            return self::BASE_URL . self::SEND_SMS_REQ . 'customerID=' . env('MTN_CUSTOMER_ID') .
                '&userName=' . config('smspro.username') . '&userPassword=' . config('smspro.password') . '&originator=' . $originator .
                '&messageType=' . self::TYPE_L . '&defDate=' . '&blink=false' . '&flash=false' . '&private=true'
                . '&smsText=' . $smsText . '&recipientPhone=' . $recipient ;


    }



    /**
     * @param $response : XML reponse to parse
     *
     * @return bool
     *
     * Parse XML response and return true if message successfully sent
     */

    private static function isRequestSuccessful($response)
    {


        $xml = simplexml_load_string( $response->getBody()->getContents() );

        if ( ( (string) $xml->Result )  === 'OK' )

            return true;

        else

            return false;


    }

}
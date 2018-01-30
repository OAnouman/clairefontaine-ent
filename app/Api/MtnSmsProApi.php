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
     */

    public static function send( Sms $sms, ApiCredential $credential = null)
    {


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

                    $messageSuccessfullySent = self::isRequestSuccess($response);


                }


            }

            return $messageSuccessfullySent;


        }
        else
        {


            dd($sms->getRecipients());
            // Single sending

            $response = $client->request('GET', self::buildSendUrl($credential, $sms->getBody(),
                $sms->getRecipients(), $sms->getOriginator() ) );

            return self::isRequestSuccess($response);


        }




    }


    static function buildAuthUrl( ApiCredential $credential = null)
    {


       if ($credential)

           return self::BASE_URL . self::AUTHENTICATED_REQ . 'customerID=' . $credential->getCustomerId() .
               '&username=' . $credential->getUsername() . '&userPassword=' . $credential->getPassword() ;

       else

           return self::BASE_URL . self::AUTHENTICATED_REQ . 'customerID=' . env('MTN_CUSTOMER_ID') .
               '&username=' . env('MTN_USERNAME') . '&userPassword=' . env('MTN_PASSWORD') ;


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

    static function buildSendUrl( $credentials, $smsText, $recipient, $originator )
    {


        if ( $credentials )

            return self::BASE_URL . self::SEND_SMS_REQ . 'customerID=' . $credentials->getCustomerId() .
                '&userName=' . $credentials->getUsername() . '&userPassword=' . $credentials->getPassword() . '&originator=' . $credentials->getOriginator() .
                '&messageType=' . self::TYPE_L . '&defDate=' . '&blink=false' . '&flash=false' . '&private=true'
                . '&smsText=' . $smsText . '&recipientPhone=' . $recipient ;

        else

            return self::BASE_URL . self::SEND_SMS_REQ . 'customerID=' . env('MTN_CUSTOMER_ID') .
                '&userName=' . env('MTN_USERNAME') . '&userPassword=' . env('MTN_PASSWORD') . '&originator=' . $originator .
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

    private static function isRequestSuccess( $response)
    {


        $xml = simplexml_load_string( $response->getBody()->getContents() );

        if ( ( (string) $xml->Result )  === 'OK' )

            return true;

        else

            return false;


    }

}
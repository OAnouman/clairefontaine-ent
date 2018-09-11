<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 10/19/2017
 * Time: 11:59 AM
 */


namespace App\Channels\Message;


use App\Student;
use function GuzzleHttp\Psr7\_parse_request_uri;


class Sms
{


    /**
     * Sms body
     *
     * @var string
     */

    protected $body;

    /**
     * Recipients number. For multiple recipients
     *
     * separate number with semi-colon
     *
     * @var string
     */

    protected $recipients;

    /**
     * Originator to send message with
     *
     * @var string
     */

    protected $originator;


    public function __construct()
    {
    }



    /**
     * @return string
     */
    public function getBody()
    {


        return  $this->body ;


    }



    /**
     * @return string
     */
    public function getRecipients()
    {


        return $this->recipients;


    }


    /**
     * @return string
     */
    public function getOriginator()
    {


        return $this->originator;


    }




    public function body($body)
    {


        $this->body = $body;

        return $this;


    }



    /**
     * Set recipient with given number
     *
     * @param string $recipient
     *
     * @return $this
     */

    public function recipient($recipient)
    {


        $this->recipient = str_replace(' ', '',  trim($recipient) ) ;

        return $this;


    }



    /**
     * Set recipient. Extract phones
     *
     * numbers from student
     *
     * @param Student $student
     *
     * @return $this
     */

    public function recipientStudent(Student $student)
    {


        $recipientsArray = explode(',', $student->father_phones .','.$student->mother_phones);

        $recipients = null;

        foreach ($recipientsArray as $recipient)
        {


            // Check if $recipient is not empty

            if ( ! empty($recipient) )
            {


                if ( str_contains( $recipient, '225' ) ) {

                    $recipients .= trim( $recipient );

                }
                else {

                    $recipients .= ( '225' . str_replace( ' ', '', trim( $recipient ) ) );

                }


            }


        }

        $this->recipients = $recipients;

        return $this;


    }



    public function __call( $name, $arguments )
    {


        if ($name === 'recipient' && $arguments instanceof Student)
        {


            return call_user_func('recipientStudent', $arguments);


        }
        else if ($name === 'recipient' && is_string($arguments))
        {


            return call_user_func( 'recipient', $arguments);


        }

        return false;


    }



    /**
     * Set originator
     *
     * @param string $originator
     *
     * @return $this
     */

    public function originator($originator)
    {


        $this->originator = $originator;

        return $this ;


    }

}
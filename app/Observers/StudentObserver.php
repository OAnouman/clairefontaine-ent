<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/5/2017
 * Time: 9:12 PM
 */


namespace App\Observers;


use App\Mail\Welcome;
use App\Notifications\StudentCreatedNotification;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Mail;
use TextUtils;


class StudentObserver
{


    public function created( Student $student )
    {


        $password = str_random(8);

        $user = new User( [

            'lastname' => $student->lastname,

            'firstname' => $student->firstname,

            'account_type' => 'eleve_parent',

            'email' => $student->username,

            'password' => bcrypt( $password ),

            'userable_id' => $student->id,

            'userable_type' => 'App\Student',


        ] );

        $user->save();

        // Sending to notify student creation en give credentials

        $student->notify( new StudentCreatedNotification( $student, $password) );

        // Sending welcome mail to each specified mail

        $emails = explode(',', trim( $student->emails ) );

        if( count($emails) > 0 )
        {


            foreach ($emails as $email)
            {


                if ( ! empty($email) )
                {


                    Mail::to( $email )

                        ->send( new Welcome( $student, $password ) );


                }


            }


        }


    }



    public function updated( Student $student )
    {


        User::where( 'email', $student->username )

            ->first()

            ->update( [


                'lastname' => $student->lastname,

                'firstname' => $student->firstname,


            ] );


    }



    public function deleted( Student $student )
    {


        User::where( 'email', $student->username )

            ->first()

            ->delete();


    }


}
<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 9/5/2017
 * Time: 10:14 AM
 */


namespace App\Observers;


use App\Mail\WelcomeTeacher;
use App\Teacher;
use App\User;
use Illuminate\Support\Facades\Mail;


class TeacherObserver
{


    /**
     * Create related user when
     *
     * a teacher is created
     *
     * @param Teacher $teacher
     */

    public function created( Teacher $teacher )
    {


        $user = new User( [

            'lastname' => $teacher->lastname,

            'firstname' => $teacher->firstname,

            'account_type' => 'professeur',

            'email' => $teacher->email,

            'password' => bcrypt( request()->password ),

            'userable_id' => $teacher->id,

            'userable_type' => 'App\Teacher',


        ] );

        $user->save();

        // Sending welcome mail

        Mail::to($user)->send( new WelcomeTeacher($teacher, request()->password) );



    }



    public function updated( Teacher $teacher )
    {


        User::where( 'email', $teacher->email )

            ->first()

            ->update( [


                'lastname' => $teacher->lastname,

                'firstname' => $teacher->firstname,

                'email' => $teacher->email,

                'password' => bcrypt( request()->password ),


            ] );


    }



    public function deleted( Teacher $teacher )
    {


        User::where( 'email', $teacher->email )
            ->first()
            ->delete();


    }
}
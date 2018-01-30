<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [

        'lastname',

        'email',

        'password',

        'firstname' ,

        'account_type',

        'userable_id',

        'userable_type',

    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [

        'password', 'remember_token',

        ];




    public function userable()
    {


        return $this->morphTo();


    }


    public function messageThreadsCreated ()
    {


        return $this->hasMany(MessageThread::class, 'originator', 'id');


    }

    public function messageThreadReceived ()
    {


        return $this->hasMany(MessageThread::class, 'recipient', 'id');


    }

    public function messageSendBy ()
    {


        return $this->hasMany(Message::class, 'originator', 'id');


    }

    public function messageSendTo ()
    {


        return $this->hasMany(Message::class, 'recipient', 'id');


    }


    public function routeNotificationForMail ()
    {


        if ( $this->userable instanceof \App\Teacher )


            return $this->email;


        else if ($this->userable instanceof \App\Student)
        {



            $emails = array_filter( explode( ',', $this->userable->emails ) );

            return $emails;


        }
        else


            return '';



    }


}

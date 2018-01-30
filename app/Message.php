<?php

namespace App;


class Message extends Model
{


    public function messageThread ()
    {


        return $this->belongsTo(MessageThread::class);


    }


    public function originatorUser ()
    {


        return $this->belongsTo(User::class, 'originator', 'id');


    }


    public function recipientUser ()
    {


        return $this->belongsTo(User::class, 'recipient', 'id');


    }

}

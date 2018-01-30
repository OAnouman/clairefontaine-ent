<?php

namespace App;


class MessageThread extends Model
{


    public function messages ()
    {


        return $this->hasMany(Message::class);


    }

    public function originatorUser ()
    {


        return $this->belongsTo(User::class, 'originator', 'id');


    }


    public function recipientUser ()
    {


        return $this->belongsTo(User::class, 'recipient', 'id');


    }


    public function unseenMessages ()
    {


        return $this->messages()->where('seen', false)

                                ->count();


    }


}

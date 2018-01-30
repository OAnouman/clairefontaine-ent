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


    /**
     * Get all messages where sent according to a period
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */

    public function scopeGetMessages (int $message_thread_id, $from, $to)
    {


        return $this->where('message_thread_id', $message_thread_id)

                      ->whereBetween('created_at', [$from, $to])

                      ->latest()

                      ->get();

    }


}

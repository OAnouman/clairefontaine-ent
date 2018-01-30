<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 10/7/2017
 * Time: 6:14 PM
 */


namespace App\Repositories;


use App\MessageThread;


class MessageThreadRepository extends Repository
{


    /**
     * @inheritdoc
     *
     * @return mixed
     *
     * Get all records
     */

    public function all()
    {


        return MessageThread::latest()->get();


    }



    /**
     * @inheritdoc
     *
     * @param array $data
     *
     * @return mixed
     *
     * Create new record
     */

    public function create( array $data )
    {


        return MessageThread::create( $data );


    }



    /**
     * @param int $id
     *
     * @return mixed
     *
     * Delete one record
     */

    public function destroy( int $id )
    {


        return MessageThread::find($id)->delete();


    }



    /**
     * @param int $id
     *
     * @return mixed
     *
     * Get a record by its id
     */

    public function get( int $id )
    {


        return MessageThread::find($id);


    }



    /**
     * @param int $id
     * @param array $data
     *
     * @return mixed
     *
     * Update one record
     */

    public function update( int $id, array $data )
    {


        return $this->get( $id )->update ( $data );


    }



    /**
     * Mark as seen all message received by the user
     *
     * @param int $thread_id
     *
     * @param int $user_id : Current user id
     */

    public function markAsSeen (int $thread_id, int $user_id )
    {


        $unseenMessages = MessageThread::find($thread_id)->messages()

                                                         ->where('recipient', $user_id)

                                                         ->where('seen', false)

                                                         ->get() ;


        foreach ($unseenMessages as $unseenMessage)
        {


            $unseenMessage->seen = true;

            $unseenMessage->save();


        }


    }


    public function newMessages ($messageThreadId, $userId)
    {


        $newMessages = MessageThread::find($messageThreadId)->messages()

                                                            ->where('recipient', $userId)

                                                            ->where('seen', false)

                                                            ->get();

        foreach ($newMessages as $newMessage)
        {


            $newMessage->seen = true;

            $newMessage->save();


        }

        return $newMessages;


    }

    public function getIfExists ( $originatorId , $recipientId)
    {


        $messageThread = null;

        $messageThread = MessageThread::where('originator', $originatorId)

                            ->where('recipient', $recipientId)

                            ->first();

        if (! $messageThread )


            return MessageThread::where('originator', $recipientId)

                                          ->where('recipient', $originatorId)

                                          ->first();


        else


            return $messageThread;


    }





}
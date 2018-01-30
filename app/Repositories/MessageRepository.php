<?php
/**
 * Created by PhpStorm.
 * User: MARTIAL ANOUMAN
 * Date: 10/9/2017
 * Time: 4:07 PM
 */


namespace App\Repositories;


use App\Message;
use App\MessageThread;


class MessageRepository extends Repository
{


    /**
     * @return mixed
     *
     * Get all records
     */

    public function all()
    {


        return Message::latest()->get();


    }



    /**
     * @param array $data
     *
     * @return mixed
     *
     * Create new record
     */

    public function create( array $data )
    {


        $message = Message::create( $data );

        $message->messageThread->touch();

        return $message;


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


        return  $this->get($id)->delete() ;


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


        return Message::find($id);


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


        return $this->get($id)->update( $data );


    }




}
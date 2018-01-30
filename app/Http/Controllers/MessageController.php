<?php

namespace App\Http\Controllers;

use App\Notifications\MessageReceivedNotification;
use App\Repositories\MessageRepository;
use App\Repositories\MessageThreadRepository;
use App\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    protected $messageRepository;

    protected $messageThreadRepository;


    public function __construct(MessageRepository $messageRepository, MessageThreadRepository $messageThreadRepository)
    {


        $this->middleware(['auth']);

        $this->messageRepository = $messageRepository;

        $this->messageThreadRepository = $messageThreadRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return string
     */

    public function store(Request $request)
    {


        $this->validate($request , [

            'body' => 'required|string',

            'message_thread_id' => 'required|integer|exists:message_threads,id',

            'recipient' => 'required|integer|exists:users,id',

            'originator' => 'required|integer|exists:users,id'

        ]);


        if ( $message = $this->messageRepository->create( $request->all() ))
        {


            // Send notification to recipient

            $user = User::find( $message->recipient );

            $user->notify( new MessageReceivedNotification($message, $user) );

            return $message->toJson();


        }

        return 'Failed';


    }


    /**
     * Update the specified resource in storage.
     *
     * @param $message_thread_id
     * @param $user_id
     *
     * @return string
     * @internal param Request $request
     * @internal param int $id
     */

    public function update($message_thread_id, $user_id)
    {


        return $this->messageThreadRepository->newMessages($message_thread_id, $user_id)->toJson();


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Teacher;

use App\MessageThread;
use App\Repositories\MessageRepository;
use App\Repositories\MessageThreadRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MercurySeries\Flashy\Flashy;
use App\Message;


class MessageCenterController extends Controller
{


    protected $redirectTo = 'message_center.index';

    protected $messageThreadRepository;

    protected $messageRepository;



    public function __construct(MessageThreadRepository $messageThreadRepository, MessageRepository $messageRepository)
    {


        $this->middleware(['auth', 'teacher']);

        $this->messageThreadRepository = $messageThreadRepository;

        $this->messageRepository = $messageRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $messageThreads = auth()->user()->userable->messageThreads();

        $students = auth()->user()->userable->students();

        return view('admin_teacher.message_center.index', compact('messageThreads', 'students'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {


        // We check if a message thread between the

        // two users doesn't already exists

        if ($messageThread = $this->messageThreadRepository->getIfExists(auth()->user()->id, $request->input('recipient_id') ) )
        {


            return redirect()->route('message_center.show', $messageThread->id);


        }

        // If not we try to create a new message thread

        $this->validate($request, [


            'recipient_id' => 'required|integer|exists:users,id',


        ]);

        $request->merge(['originator' => auth()->user()->id]);

        if ($messageThread = $this->messageThreadRepository->create( $request->all()) )
        {


            return redirect()->route('message_center.show', $messageThread->id);


        }


        // If none of the above works it might be en error

        Flashy::error('Une erreur est survenue lors de l\'initialisation du fil de discussion !');
        
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(int  $id)
    {


        $messageThread = $this->messageThreadRepository->get($id);

        // Setting up dates

        $from = Carbon::now();

        $from->subMonths(3);

        $to = Carbon::now();

        $messages = $this->messageRepository->getMessages($messageThread->id, $from, $to);

        // Mark thread unseen message as seen

        $this->messageThreadRepository->markAsSeen($messageThread->id, auth()->user()->id );

        return view('admin_teacher.message_center.show', compact('messageThread', 'messages'));


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

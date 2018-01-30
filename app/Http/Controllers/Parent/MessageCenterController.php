<?php

namespace App\Http\Controllers\Parent;

use App\Repositories\MessageRepository;
use App\Repositories\MessageThreadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MessageCenterController extends Controller
{


    protected $redirectTo = 'message_center_parent.index';

    protected $messageThreadRepository;

    protected $messageRepository;


    public function __construct(MessageThreadRepository $messageThreadRepository, MessageRepository $messageRepository)
    {


        $this->middleware(['auth', 'parent']);

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


        $student = Auth::user()->userable;

        $messageThreads = auth()->user()->userable->messageThreads();

        $teachers = $student->currentClassroom()->teachers ;

        return view('admin_parent.message_center.index',
            compact('messageThreads', 'teachers', 'student'));



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

        if ($messageThread = $this->messageThreadRepository->getIfExists(auth()->user()->id, $request->input('recipient') ) )
        {


            return redirect()->route('message_center_parent.show', $messageThread->id);


        }


        $this->validate($request, [


            'recipient' => 'required|integer|exists:users,id',


        ]);

        $request->merge(['originator' => auth()->user()->id]);

        if ($messageThread = $this->messageThreadRepository->create( $request->all()) )
        {


            return redirect()->route('message_center_parent.show', $messageThread->id);


        }

        Flashy::error('Une erreur est survenue lors de l\'initialisation du fil de discussion !');

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $student = Auth::user()->userable;

        $messageThread = $this->messageThreadRepository->get($id);

        $messages = auth()->user()->userable->messages($messageThread->id);

        // Mark thread unseen message as seen

        $this->messageThreadRepository->markAsSeen($messageThread->id, auth()->user()->id);

        return view('admin_parent.message_center.show',
            compact('messageThread', 'messages', 'student'));


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

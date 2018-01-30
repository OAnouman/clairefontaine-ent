<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Repositories\SubjectRepository;


class SubjectController extends Controller
{


    protected $subjectRepository;

    protected $redirectTo = 'subject.index';



    public function __construct( SubjectRepository $subjectRepository )
    {


        $this->middleware( ['auth', 'admin'] );

        $this->subjectRepository = $subjectRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $subjects = $this->subjectRepository->allPaginate();

        return view('subject.index', compact('subjects'));


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {


        return view('subject.create');


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store( SubjectRequest $request )
    {


        /*
       * Save and flash message to session
       */

        if ( $this->subjectRepository->create( $request->all() ) ) {


            session()->flash( 'success', 'La matière à été créee avec succès !' );


        }

        else {


            session()->flash( 'failed', 'une erreur est survenue lors de l\'enregistrement.' );


        }


        return redirect( )->route($this->redirectTo);


    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function edit( $id )
    {


        $subject = $this->subjectRepository->get($id);

        return view('subject.edit', compact('subject'));


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function update( SubjectRequest $request, $id )
    {


        if ( $this->subjectRepository->update(
            $id,
            $request->all() ) ) {


            session()->flash( 'success', 'La matière à été modifiée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la modification.' );


        }

        return redirect( )->route($this->redirectTo);


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function destroy( $id )
    {


        if ( $this->subjectRepository->destroy( $id ) ) {


            session()->flash( 'success', 'Le niveau à été supprimé avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la suppression.' );


        }


        return redirect( )->route($this->redirectTo);


    }
}

<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\LevelSubjectRequest;
use App\Repositories\LevelRepository;
use App\Repositories\SubjectRepository;


class LevelSubjectController extends Controller
{


    protected $levelRepository;

    protected $redirectTo = 'level_subject.index';



    public function __construct( LevelRepository $levelRepository )
    {


        $this->middleware( ['auth', 'admin'] );

        $this->levelRepository = $levelRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $levels = $this->levelRepository->allLevelSubject();


        return view( 'level_subject.index', compact( 'levels') );


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {



        $levels = $this->levelRepository->all()
                                        ->get();

        $subjects = new SubjectRepository();

        $subjects = $subjects->all()
                             ->get();


        return view( 'level_subject.create', compact( 'levels', 'subjects' ) );


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store( LevelSubjectRequest $request )
    {


        //dd($request);

        /*
       * Attach and flash message to session
       */

        if ( $this->levelRepository->attachSubject( $request->all() ) ) {


            session()->flash( 'success', 'Action effectuée avec succès !' );


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

    public function edit( int $level, int $subject )
    {


        $levels = $this->levelRepository->all()

                                        ->get();

        $subjects = new SubjectRepository();

        $subjects = $subjects->all()

                             ->get();

        $levelSubject = $this->levelRepository->getLevelSubjectPivot( $level, $subject );

        return view( 'level_subject.edit', compact( 'levels', 'subjects', 'levelSubject' ) );


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */


    public function update( LevelSubjectRequest $request )
    {


        if ( $this->levelRepository->updateLevelSubject(
            $request->all() ) ) {


            session()->flash( 'success', 'Action effectuée avec succès !' );


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

    public function destroy( int $level, int $subject )
    {


        if ( $this->levelRepository->detachSubject( $level, $subject ) ) {


            session()->flash( 'success', 'Action effectuée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la suppression.' );


        }


        return redirect( )->route($this->redirectTo);


    }
}

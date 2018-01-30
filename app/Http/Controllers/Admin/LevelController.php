<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\LevelRequest;
use App\Repositories\LevelRepository;
use Illuminate\Http\Request;


class LevelController extends Controller
{


    protected $levelRepository;


    /**
     * @var string
     *
     * Where to redirect after action
     */

    protected $redirectTo = 'level.index';



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


        $levels = $this->levelRepository->allPaginate();

        return view( 'level.index', compact( 'levels' ) );


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {


        return view( 'level.create' );


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store( LevelRequest $request )
    {


        /*
        * Save and flash message to session
        */

        if ( $this->levelRepository->create( $request->all() ) ) {


            session()->flash( 'success', 'Le niveau à été crée avec succès !' );


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


        $level = $this->levelRepository->get( $id );

        return view( 'level.edit', compact( 'level' ) );


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function update( LevelRequest $request, $id )
    {



        if ( $this->levelRepository->update(
            $id,
            $request->all() ) ) {


            session()->flash( 'success', 'Le niveau à été modifié avec succès !' );


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


        if ( $this->levelRepository->destroy( $id ) ) {


            session()->flash( 'success', 'Le niveau à été supprimé avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la suppression.' );


        }


        return redirect( )->route($this->redirectTo);


    }


}

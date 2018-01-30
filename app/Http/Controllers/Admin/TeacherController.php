<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Repositories\TeacherRepository;
use Carbon\Carbon;


class TeacherController extends Controller
{


    /**
     * Where to redirect after action
     *
     * @var string
     */

    protected $redirectTo = 'teacher.index';

    /**
     * Teacher repository instance
     *
     * @var
     */

    protected $teacherRepository;



    /**
     * @inheritdoc
     *
     * TeacherController constructor.
     */

    public function __construct( TeacherRepository $teacherRepository )
    {


        $this->middleware( ['auth', 'admin'] );

        $this->teacherRepository = $teacherRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $teachers = $this->teacherRepository->allPaginate();

        return view( 'teacher.index', compact( 'teachers' ) );


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {


        return view( 'teacher.create' );


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store( TeacherRequest $request )
    {


        /*
         * Save, create linked user and
         *
         * flash message to session
       */


        $data = $request->all();

        //Parse all date in valid format

        if ( $data[ 'birth_date' ] ) {


            $data[ 'birth_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'birth_date' ] );


        }

        if ( $data[ 'hire_date' ] ) {


            $data[ 'hire_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'hire_date' ] );


        }

        if ( $data[ 'leaving_date' ] ) {


            $data[ 'leaving_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'leaving_date' ] );


        }

        if ( $teacher = $this->teacherRepository->create( $data ) ) {



            session()->flash( 'success', 'L\'enseignant à été crée avec succès !' );


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


        $teacher = $this->teacherRepository->get( $id );

        return view( 'teacher.edit', compact( 'teacher' ) );


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function update( TeacherRequest $request, $id )
    {

        // Check if password is set, then add it

        // to request

        $data = $request->except( 'password' );

        if ( $request->input( 'password' ) )
        {


            $data['password'] = $request->input('password');


        }

        //Parse all date in valid format

        if ( $data[ 'birth_date' ] ) {


            $data[ 'birth_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'birth_date' ] );


        }

        if ( $data[ 'hire_date' ] ) {


            $data[ 'hire_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'hire_date' ] );


        }

        if ( $data[ 'leaving_date' ] ) {


            $data[ 'leaving_date' ] = Carbon::createFromFormat( 'd-m-Y', $data[ 'leaving_date' ] );


        }

        if ( $this->teacherRepository->update(
            $id,
            $data ) ) {


            session()->flash( 'success', 'L\' enseignant à été modifié avec succès !' );


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


        if ( $this->teacherRepository->destroy( $id ) ) {


            session()->flash( 'success', 'Le niveau à été supprimé avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la suppression.' );


        }


        return redirect( )->route($this->redirectTo);


    }
}

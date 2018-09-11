<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Repositories\ClassroomRepository;
use App\Repositories\SchoolYearRepository;
use App\SchoolYear;


class ClassroomController extends Controller
{


    /**
     * Repository
     *
     * @var
     */

    protected $classroomRepository;

    /**
     * Where to redirect
     *
     * @var string
     */

    protected $redirectTo = 'classroom.index';



    public function __construct( ClassroomRepository $classroomRepository )
    {


        $this->middleware( ['auth', 'admin'] );

        $this->classroomRepository = $classroomRepository;


    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {



        if ( request( 'school-year' ) ) {

            //Retrieving school year parameter in url

            $schoolYear = new SchoolYearRepository();

            $schoolYear = $schoolYear->getByName( request( 'school-year' ) );

            // Filter classroom by school year and paginate

            $classrooms = $this->classroomRepository->getClassroomsOfYear($schoolYear)
                                                    ->paginate();

        }

        else {



            $classrooms = $this->classroomRepository->all()
                                                    ->paginate();


        }


        return view( 'classroom.index', compact( 'classrooms' ) );


    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {


        // Classrooms by level type

        $levelRepo = new  \App\Repositories\LevelRepository;

        $kindergarten = $levelRepo->getLevelsBy( 'Maternelle' );

        $elementary = $levelRepo->getLevelsBy( 'Primaire' );

        $secondary = $levelRepo->getLevelsBy( 'Secondaire' );


        //School year

        $schoolYears = new \App\Repositories\SchoolYearRepository;

        $schoolYears = $schoolYears->all();

        // Teachers

        $teachers = new \App\Repositories\TeacherRepository;

        $teachers = $teachers->all()->get();

        return view( 'classroom.create',
            compact( 'kindergarten', 'elementary', 'secondary', 'schoolYears','teachers' ) );


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */

    public function store( ClassroomRequest $request )
    {


        /*
        * Save and flash message to session
        */

        //Retrieve Level id and put it in the data array

        $level = new \App\Repositories\LevelRepository;

        $data = $request->all();

        $data[ 'level_id' ] = $level->getByName( $request->input( 'level_id' ) )->id;;


        if ( $this->classroomRepository->create( $data ) ) {


            session()->flash( 'success', 'La classe à été créée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'une erreur est survenue lors de l\'enregistrement.' );


        }


        return redirect(  )->route($this->redirectTo);


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


        // Classrooms by level type

        $levelRepo = new  \App\Repositories\LevelRepository;

        $kindergarten = $levelRepo->getLevelsBy( 'Maternelle' );

        $elementary = $levelRepo->getLevelsBy( 'Primaire' );

        $secondary = $levelRepo->getLevelsBy( 'Secondaire' );

        //School year

        $schoolYears = new \App\Repositories\SchoolYearRepository;

        $schoolYears = $schoolYears->all();

        $classroom = $this->classroomRepository->get( $id );

        //Teachers

        $teachers = new \App\Repositories\TeacherRepository;

        $teachers = $teachers->all()->get();

        return view( 'classroom.edit', compact( 'classroom',
            'kindergarten', 'elementary', 'secondary' , 'schoolYears', 'teachers') );


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */

    public function update( ClassroomRequest $request, $id )
    {


        //Retrieve Level id and put it in the data array

        $level = new \App\Repositories\LevelRepository;

        $data = $request->all();

        $data[ 'level_id' ] = $level->getByName( $request->input( 'level_id' ) )->id;;


        if ( $this->classroomRepository->update(
            $id,
            $data ) ) {


            session()->flash( 'success', 'La classe à été modifiée avec succès !' );


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


        if ( $this->classroomRepository->destroy( $id ) ) {


            session()->flash( 'success', 'La classe à été supprimée avec succès !' );


        }

        else {


            session()->flash( 'failed', 'Une erreur est survenue lors de la suppression.' );


        }


        return redirect( )->route($this->redirectTo);


    }


    public function ajaxGetClassroom(int $school_year)
    {


        return $this->classroomRepository->all()

                                         ->where('school_year_id',$school_year)

                                         ->get(['id', 'name']);


    }
}

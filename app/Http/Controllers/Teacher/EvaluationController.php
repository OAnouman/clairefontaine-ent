<?php

namespace App\Http\Controllers\Teacher;

use App\Evaluation;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationRequest;
use App\Repositories\ClassroomRepository;
use App\Repositories\EvaluationRepository;
use App\Repositories\TeacherRepository;
use App\SchoolYear;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MercurySeries\Flashy\Flashy;


class EvaluationController extends Controller
{



    protected $evaluationRepository ;

    protected $teacherRepository ;

    protected $redirectTo = 'evaluation.index';


    public function __construct(EvaluationRepository  $evaluationRepository, TeacherRepository $teacherRepository)
    {


        $this->middleware(['auth', 'teacher']);

        $this->evaluationRepository = $evaluationRepository ;

        $this->teacherRepository = $teacherRepository;

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {


        $evaluations = $this->evaluationRepository->paginate();

        $classrooms = $this->teacherRepository->classrooms( auth()->user()->userable);

        $schoolYearPeriods = SchoolYear::latest()->first()->schoolYearPeriods;

        $subjects = [];

        foreach ($classrooms as $classroom)
        {


            $subjects[] = Subject::find( $classroom->pivot->subject_id );


        }

        $subjects = array_unique($subjects);


        return view('admin_teacher.evaluation.index',
            compact('evaluations', 'classrooms', 'subjects', 'schoolYearPeriods'));


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {




    }



    /**
     * Store a newly created resource in storage.
     *
     * @param EvaluationRequest|Request $request
     *
     * @return string
     */

    public function store(EvaluationRequest $request)
    {

        $data = $request->all();

        $data['evaluation_date'] = Carbon::createFromFormat( 'd-m-Y', $data[ 'evaluation_date' ] );

        if ($this->evaluationRepository->create( $data ))
        {


            Flashy::success('Evaluation créée avec succès !' );


        }
        else
        {


            Flashy::error('Une erreur est survenue lors de l\'enregistrement.' );


        }



        return 'OK';


    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function show( int $id )
    {


        $evaluation = $this->evaluationRepository->get($id);

        return view('admin_teacher.evaluation.show', compact('evaluation') );


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluation  $evalution
     *
     * @return \Illuminate\Http\Response
     */

    public function edit( Evaluation $evaluation)
    {
        //
    }



    /**
     * Update the specified resource in storage.
     *
     * @param EvaluationRequest|Request $request
     * @param int $id
     *
     * @return string
     *
     * @internal param Evaluation $evalution
     *
     */

    public function update( EvaluationRequest $request, int $id)
    {


        $data = $request->all();

        $data['evaluation_date'] = Carbon::createFromFormat( 'd-m-Y', $data[ 'evaluation_date' ] );

        if ( $this->evaluationRepository->update($id , $data) )
        {


            Flashy::success('Modification effectuée avece succès !');


        }
        else
        {


            Flashy::error('Une erreur est survenue lors de la modification.');


        }

        return 'OK';


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return string
     */

    public function destroy( int $id)
    {


        if ($this->evaluationRepository->destroy( $id ))
        {


            Flashy::success('Evaluation supprimée avec succès !');


        }
        else
        {


            Flashy::error('Une erreur est survenue lors de la suppression.' );


        }

        return redirect()->route($this->redirectTo);


    }
}
